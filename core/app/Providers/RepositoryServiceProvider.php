<?php

namespace App\Providers;

use App\Data\IRepositories\Auth\IAccessRepository;
use App\Data\IRepositories\Auth\IPermissionsRepository;
use App\Data\IRepositories\Auth\IRoleAccessRepository;
use App\Data\IRepositories\IAgencyRepository;
use App\Data\IRepositories\IClientEnrollRepository;
use App\Data\IRepositories\IClientRepository;
use App\Data\IRepositories\IDepartmentRepository;
use App\Data\IRepositories\IEmployeeRepository;
use App\Data\IRepositories\IRoleRepository;
use App\Data\IRepositories\IServiceRepository;
use App\Data\IRepositories\IUserRepository;
use App\Data\IRepositories\Modules\Chat\IChatFileRepository;
use App\Data\IRepositories\Modules\Chat\IChatGroupParticipantRepository;
use App\Data\IRepositories\Modules\Chat\IChatGroupRepository;
use App\Data\IRepositories\Modules\Chat\IChatRepository;
use App\Data\IRepositories\Projects\IProjectAccessRepository;
use App\Data\IRepositories\Projects\IProjectAccessRequestRepository;
use App\Data\IRepositories\Projects\IProjectActivityRepository;
use App\Data\IRepositories\Projects\IProjectDocumentRepository;
use App\Data\IRepositories\Projects\IProjectIntegrationKeywordRepository;
use App\Data\IRepositories\Projects\IProjectRepository;
use App\Data\IRepositories\Projects\IProjectServiceRepository;
use App\Data\IRepositories\Projects\IProjectTeamRepository;
use App\Data\IRepositories\Projects\IRankingReportRepository;
use App\Data\IRepositories\Projects\Task\ITaskActionItemsRepository;
use App\Data\IRepositories\Projects\Task\ITaskArchiveRepository;
use App\Data\IRepositories\Projects\Task\ITaskAssignToRepository;
use App\Data\IRepositories\Projects\Task\ITaskAttachmentsRepository;
use App\Data\IRepositories\Projects\Task\ITaskCommentsRepository;
use App\Data\IRepositories\Projects\Task\ITaskDetailsRepository;
use App\Data\IRepositories\Projects\Task\ITaskRepository;
use App\Data\IRepositories\Projects\Task\ITaskTimeTrackerRepository;
use App\Data\Repositories\AgencyRepository;
use App\Data\Repositories\Auth\AccessRepository;
use App\Data\Repositories\Auth\PermissionsRepository;
use App\Data\Repositories\Auth\RoleAccessRepository;
use App\Data\Repositories\ClientEnrollRepository;
use App\Data\Repositories\ClientRepository;
use App\Data\Repositories\DepartmentRepository;
use App\Data\Repositories\EmployeeRepository;
use App\Data\Repositories\Modules\Chat\ChatFileRepository;
use App\Data\Repositories\Modules\Chat\ChatGroupParticipantRepository;
use App\Data\Repositories\Modules\Chat\ChatGroupRepository;
use App\Data\Repositories\Modules\Chat\ChatRepository;
use App\Data\Repositories\Projects\ProjectAccessRepository;
use App\Data\Repositories\Projects\ProjectAccessRequestRepository;
use App\Data\Repositories\Projects\ProjectActivityRepository;
use App\Data\Repositories\Projects\ProjectDocumentRepository;
use App\Data\Repositories\Projects\ProjectIntegrationKeywordRepository;
use App\Data\Repositories\Projects\ProjectRepository;
use App\Data\Repositories\Projects\ProjectServiceRepository;
use App\Data\Repositories\Projects\ProjectTeamRepository;
use App\Data\Repositories\Projects\RankingReportRepository;
use App\Data\Repositories\Projects\Task\TaskActionItemsRepository;
use App\Data\Repositories\Projects\Task\TaskArchiveRepository;
use App\Data\Repositories\Projects\Task\TaskAssignToRepository;
use App\Data\Repositories\Projects\Task\TaskAttachmentsRepository;
use App\Data\Repositories\Projects\Task\TaskCommentsRepository;
use App\Data\Repositories\Projects\Task\TaskDetailsRepository;
use App\Data\Repositories\Projects\Task\TaskRepository;
use App\Data\Repositories\Projects\Task\TaskTimeTrackerRepository;
use App\Data\Repositories\RoleRepository;
use App\Data\Repositories\ServiceRepository;
use App\Data\Repositories\UserRepository;
use App\Models\Project\RankingReport;
use App\Services\FileOperationService;
use App\Services\Interfaces\IFileOperationService;
use App\Services\Interfaces\IMailService;
use App\Services\MailService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Service register
        $this->app->bind(IFileOperationService::class, FileOperationService::class);
        $this->app->bind(IMailService::class, MailService::class);

        //Repository Register
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IRoleRepository::class, RoleRepository::class);
        $this->app->bind(IAgencyRepository::class, AgencyRepository::class);
        $this->app->bind(IDepartmentRepository::class, DepartmentRepository::class);
        $this->app->bind(IEmployeeRepository::class, EmployeeRepository::class);
        $this->app->bind(IServiceRepository::class, ServiceRepository::class);
        $this->app->bind(IClientRepository::class, ClientRepository::class);
        $this->app->bind(IClientEnrollRepository::class, ClientEnrollRepository::class);
        $this->app->bind(IProjectRepository::class, ProjectRepository::class);
        $this->app->bind(IProjectServiceRepository::class, ProjectServiceRepository::class);
        $this->app->bind(IProjectTeamRepository::class, ProjectTeamRepository::class);
        $this->app->bind(IProjectDocumentRepository::class, ProjectDocumentRepository::class);
        $this->app->bind(IProjectActivityRepository::class, ProjectActivityRepository::class);
        $this->app->bind(IProjectAccessRepository::class, ProjectAccessRepository::class);
        $this->app->bind(IProjectAccessRequestRepository::class, ProjectAccessRequestRepository::class);
        $this->app->bind(IProjectIntegrationKeywordRepository::class, ProjectIntegrationKeywordRepository::class);
        $this->app->bind(IRankingReportRepository::class, RankingReportRepository::class);

        $this->app->bind(IChatRepository::class, ChatRepository::class);
        $this->app->bind(IChatGroupRepository::class, ChatGroupRepository::class);
        $this->app->bind(IChatGroupParticipantRepository::class, ChatGroupParticipantRepository::class);
        $this->app->bind(IChatFileRepository::class, ChatFileRepository::class);
        $this->app->bind(IChatRepository::class, ChatRepository::class);

        //Task
        $this->app->bind(ITaskRepository::class, TaskRepository::class);
        $this->app->bind(ITaskAssignToRepository::class, TaskAssignToRepository::class);
        $this->app->bind(ITaskArchiveRepository::class, TaskArchiveRepository::class);
        $this->app->bind(ITaskTimeTrackerRepository::class, TaskTimeTrackerRepository::class);
        $this->app->bind(ITaskDetailsRepository::class, TaskDetailsRepository::class);
        $this->app->bind(ITaskAttachmentsRepository::class, TaskAttachmentsRepository::class);
        $this->app->bind(ITaskCommentsRepository::class, TaskCommentsRepository::class);
        $this->app->bind(ITaskActionItemsRepository::class, TaskActionItemsRepository::class);


        $this->app->bind(IAccessRepository::class, AccessRepository::class);
        $this->app->bind(IRoleAccessRepository::class, RoleAccessRepository::class);
        $this->app->bind(IPermissionsRepository::class, PermissionsRepository::class);

    }
}
