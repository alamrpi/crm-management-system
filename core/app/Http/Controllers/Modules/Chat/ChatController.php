<?php

namespace App\Http\Controllers\Modules\Chat;

use App\Data\IRepositories\IUserRepository;
use App\Data\IRepositories\Modules\Chat\IChatFileRepository;
use App\Data\IRepositories\Modules\Chat\IChatGroupParticipantRepository;
use App\Data\IRepositories\Modules\Chat\IChatGroupRepository;
use App\Data\IRepositories\Modules\Chat\IChatRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\Chat\SendMessageRequest;
use App\Services\Interfaces\IFileOperationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class ChatController extends Controller
{
    private $userRepository;
    private $chatRepository;
    private $chatFileRepository;
    private $chatGroupRepository;
    private $chatGroupParticipantRepository;
    private $fileOperationService;

    public function __construct(
        IUserRepository $userRepository,
        IChatRepository $chatRepository,
        IChatFileRepository $chatFileRepository,
        IChatGroupRepository $chatGroupRepository,
        IFileOperationService $fileOperationService,
        IChatGroupParticipantRepository $chatGroupParticipantRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->chatRepository = $chatRepository;
        $this->chatFileRepository = $chatFileRepository;
        $this->chatGroupRepository = $chatGroupRepository;
        $this->fileOperationService = $fileOperationService;
        $this->chatGroupParticipantRepository = $chatGroupParticipantRepository;
    }
    public function index()
    {
        $profile = $this->userRepository->getUserById(Auth::user()->id);
        return view('modules.chat.index', compact('profile'));
    }

    public function chatRequiredData($id, $dataType = 0)
    {
        try {
            $data['group'] = $this->chatGroupRepository->getGroupById($id);
            $data['chatParticipants'] = $this->chatGroupParticipantRepository->getParticipantByGroupId($id);
            if ($dataType == 1){
                $data['chatParticipants'] = $this->chatGroupParticipantRepository->getParticipantByGroupId($id);
            }
            if ($dataType == 2 ){
                $data['chatData'] = 'chat data';
            }
            if ($data['group']->group_type == 1){
                foreach($data['chatParticipants'] as $row){
                    if ($row->id != Auth::user()->id) {
                        $data['group']->group_name = $row->name;
                        $data['group']->photo = $row->photo;
                    }
                }
            }
            return response()->json([
                'status'        => 200,
                'message'       => '',
                'data'          => $data
            ]);

        }catch (\Exception $ex){
            return response()->json([
                'status'        => 500,
                'message'       => '',
                'data'          => $ex->getMessage()
            ]);
        }
    }

    public function sendMessage(SendMessageRequest $messageRequest)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $message = $messageRequest->validated();
            $groupId = $message['groupId'];
            $messageModel['group_id']           = $groupId;
            $messageModel['participant_id']     = $user->id;
            $messageModel['message']            = $message['chatMessage'];
            $messageModel['created_at']         = Carbon::now();
            $messageModel['updated_at']         = Carbon::now();
            $messageId = $this->chatRepository->store($messageModel);
            if ($messageId){
                if (isset($message['chatFiles']) && count($message['chatFiles'])){
                    foreach ($message['chatFiles'] as $file){
                            $fileInfo = $this->fileOperationService->upload($file,"uploads/modules/chats/message/");
                            $fileModel = $fileInfo;
                            $fileModel['chat_message_id'] = $messageId;
                            $this->chatFileRepository->store($fileModel);
                    }
                }
            }
            DB::commit();
            return $this->getChatMessage($groupId, $messageId);
        }catch(\Exception $ex){
            DB::rollBack();
            return response()->json([
                'status'        => 500,
                'message'       => '',
                'data'          => $ex->getMessage()
            ]);
        }
    }

    public function getChatMessage($groupId, $messageId = null)
    {
        try {

            $messages = isNull($messageId) ? $this->chatRepository->getMessages($groupId, $messageId) : $this->chatRepository->getMessages($groupId)->toArray();
            foreach ($messages as $key => $message){
                if ($message->file_count)
                    $messages[$key]->files = $this->chatFileRepository->getChatFiles($message->id)->toArray();
            }
            return response()->json([
                'status'        => 200,
                'message'       => $messageId,
                'data'          => $messages,
                'user'          => Auth::user()->id
            ]);
        }catch(\Exception $ex){
            return response()->json([
                'status'        => 500,
                'message'       => '',
                'data'          => $ex->getMessage()
            ]);
        }
    }

    public function getChatHistory()
    {
        try {
            $user = Auth::user();
            $chatList = $this->chatRepository->getChatHistory($user->id)->unique('id');
            return response()->json([
                'status'        => 200,
                'message'       => '',
                'data'          => $chatList,
            ]);
        }catch(\Exception $ex){
            return response()->json([
                'status'        => 500,
                'message'       => '',
                'data'          => $ex->getMessage()
            ]);
        }
    }

}
