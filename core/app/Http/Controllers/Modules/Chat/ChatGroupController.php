<?php

namespace App\Http\Controllers\Modules\Chat;

use App\Constants\EmployeeTypes;
use App\Data\IRepositories\IUserRepository;
use App\Data\IRepositories\Modules\Chat\IChatGroupParticipantRepository;
use App\Data\IRepositories\Modules\Chat\IChatGroupRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Modules\Chat\ChatGroupRequest;
use App\Services\Interfaces\IFileOperationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class ChatGroupController extends Controller
{
    private $chatGroupRepository;
    private $chatGroupParticipantRepository;
    private $fileOperationService;

    private $userRepository;

    public function __construct(
        IChatGroupRepository $chatGroupRepository,
        IFileOperationService $fileOperationService,
        IChatGroupParticipantRepository $chatGroupParticipantRepository,
        IUserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->chatGroupRepository = $chatGroupRepository;
        $this->fileOperationService = $fileOperationService;
        $this->chatGroupParticipantRepository = $chatGroupParticipantRepository;
    }

    /**
     * @param ChatGroupRequest $chatGroupRequest
     * @return JsonResponse
     */
    public function store(ChatGroupRequest $chatGroupRequest)
    {
        try {
            DB::beginTransaction();
            $model  = $chatGroupRequest->validated();
            $user   = Auth::user();

            if(!empty($model['photo']))
            {
                $fileInfo = $this->fileOperationService->crop($model['photo'],"uploads/modules/chats/groups/", 100, 100);
                $model['photo'] = $fileInfo;
            }else
            {
                $model['photo'] = 'uploads/modules/chats/groups/default.png';
            }
            $model['group_type'] = 2;
            $model['created_by'] = $user->id;
            //insert group to group table
            $groupId = $this->chatGroupRepository->store($model);
            //insert self to group
            $this->chatGroupParticipantRepository->store(['group_id'=>$groupId, 'participant_id'=>$user->id]);
            $groupParticipants = $model['groupParticipant'];
            foreach($groupParticipants as $participant){
                // insert selected model to chat_group_participant table
                $participantModel['group_id'] = $groupId;
                $participantModel['participant_id'] = $participant;
                $this->chatGroupParticipantRepository->store($participantModel);
            }
            DB::commit();
            return response()->json([
                'status'        => 200,
                'message'       => '',
                'data'          => $groupId
            ]);

        }catch(\Exception $ex){
            DB::rollBack();
            return response()->json([
                'status'        => 500,
                'message'       => '',
                'data'          => $ex->getMessage()
            ]);
        }
    }

    public function memberSuggestion()
    {
        try {
            $user = Auth::user();
            $queryType = EmployeeTypes::getEmployeeTypeFromRole($user->id);
            $suggestion = $this->chatGroupRepository->memberSuggestion($user->agency_id, $queryType, $user->id);
            return response()->json([
                'status'        => 200,
                'message'       => '',
                'data'          => $suggestion
            ]);
        }catch(\Exception $ex) {
            return response()->json([
                'status'        => 500,
                'message'       => '',
                'data'          => $ex->getMessage()
            ]);
        }
    }

    public function getGroupById()
    {
        try {
            $user = Auth::user();
            $groupList = $this->chatGroupRepository->getGroupById($user->id);
            return response()->json([
                'status'        => 200,
                'message'       => '',
                'data'          => $groupList
            ]);
        }catch (Exception $ex){
            return response()->json([
                'status'        => 5000,
                'message'       => '',
                'data'          => $ex->getMessage()
            ]);
        }
    }

    public function getGroupsByUserId()
    {
        try {
            $user = Auth::user();
            $groupList = $this->chatGroupRepository->getGroupsByUserId($user->id);
            return response()->json([
                'status'        => 200,
                'message'       => '',
                'data'          => $groupList
            ]);
        }catch (Exception $ex){
            return response()->json([
                'status'        => 5000,
                'message'       => '',
                'data'          => $ex->getMessage()
            ]);
        }
    }

//    public function getGroupById($id)
//    {
//        try {
//            $gruop = $this->chatGroupParticipantRepository->getParticipantByGroupId($id);
//            return response()->json([
//                'status'        => 200,
//                'message'       => '',
//                'data'          => $gruop
//            ]);
//
//        }catch (Exception $ex){
//            return response()->json([
//                'status'        => 5000,
//                'message'       => '',
//                'data'          => $ex->getMessage()
//            ]);
//        }
//    }

    public function newPersonalChat()
    {
        DB::beginTransaction();
        try {
            $memberId = request()->input('user_id');
            $member = $this->userRepository->getUserById($memberId);
            $user = Auth::user();
            $check = $this->chatGroupRepository->checkPersonalGroupExist($user->id, $member->id);
            if ($check->count()){
                return response()->json([
                    'status'        => 200,
                    'message'       => 'Group Already Exist !',
                    'data'          => [
                        'groupId'   => $check->first()->id
                    ]
                ]);
            }
            $model = [
                'group_name'            => $member->name,
                'group_type'            => 1,
                'photo'                 => $member->photo,
                'created_by'            => $user->id,
            ];
            $groupId = $this->chatGroupRepository->store($model);
            $this->chatGroupParticipantRepository->store([
                'group_id'          => $groupId,
                'participant_id'    => $user->id
            ]);
            $this->chatGroupParticipantRepository->store([
                'group_id'          => $groupId,
                'participant_id'    => $member->id
            ]);
            DB::commit();
            return response()->json([
                'status'        => 200,
                'message'       => 'New Group Created',
                'data'          => [
                    'groupId'   =>$groupId
                ]
            ]);
        }catch (Exception $ex){
            DB::rollBack();
            return response()->json([
                'status'        => 5000,
                'message'       => '',
                'data'          => $ex->getMessage()
            ]);
        }
    }
}
