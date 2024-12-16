<?php

namespace App\Enums;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasLabel;

enum PermissionEnum: string implements HasLabel
{
    use EnumConcern;

    // Admin Panel
    case ViewAdminPanel = 'View Admin Panel';
    // Roles
    case ViewAnyRoles = 'View Any Roles';
    case CreateRoles = 'Create Roles';
    case UpdateAnyRoles = 'Update Any Roles';
    case DeleteAnyRoles = 'Delete Any Roles';
    // Permissions
    case ViewAnyPermissions = 'View Any Permissions';
    // Users
    case ViewAnyUsers = 'View Any Users';
    case ViewOwnedUsers = 'View Owned Users';
    case CreateUsers = 'Create Users';
    case DeleteAnyUsers = 'Delete Any Users';
    case UpdateAnyUsers = 'Update Any Users';
    case UpdateOwnedUsers = 'Update Owned Users';
    // Reward Programs
    case ViewAnyRewardPrograms = 'View Reward Programs';
    case CreateRewardPrograms = 'Create Reward Programs';
    case DeleteAnyRewardPrograms = 'Delete Any Reward Programs';
    case UpdateAnyRewardPrograms = 'Update Any Reward Programs';
    // Reward Program Categories
    case ViewAnyRewardProgramCategories = 'View Reward Program Categories';
    case CreateRewardProgramCategories = 'Create Reward Program Categories';
    case DeleteAnyRewardProgramCategories = 'Delete Any Reward Program Categories';
    case UpdateAnyRewardProgramCategories = 'Update Any Reward Program Categories';
    // Target Groups
    case ViewAnyTargetGroups = 'View Target Groups';
    case CreateTargetGroups = 'Create Target Groups';
    case DeleteAnyTargetGroups = 'Delete Any Target Groups';
    case UpdateAnyTargetGroups = 'Update Any Target Groups';
    // Event Program Categories
    case ViewAnyEventProgramCategories = 'View Event Program Categories';
    case CreateEventProgramCategories = 'Create Event Program Categories';
    case DeleteAnyEventProgramCategories = 'Delete Any Event Program Categories';
    case UpdateAnyEventProgramCategories = 'Update Any Event Program Categories';
    // Event Programs
    case ViewAnyEventPrograms = 'View Event Programs';
    case ViewOwnedEventPrograms = 'View Owned Event Programs';
    case CreateEventPrograms = 'Create Event Programs';
    case DeleteAnyEventPrograms = 'Delete Any Event Programs';
    case DeleteOwnedEventPrograms = 'Delete Owned Event Programs';
    case UpdateAnyEventPrograms = 'Update Any Event Programs';
    case UpdateOwnedEventPrograms = 'Update Owned Event Programs';
    // Banners
    case ViewAnyBanners = 'View Banners';
    case CreateBanners = 'Create Banners';
    case DeleteAnyBanners = 'Delete Any Banners';
    case UpdateAnyBanners = 'Update Any Banners';
    // Contests
    case ViewAnyContests = 'View Contests';
    case CreateContests = 'Create Contests';
    case DeleteAnyContests = 'Delete Any Contests';
    case UpdateAnyContests = 'Update Any Contests';
    // Contest Categories
    case ViewAnyContestCategories = 'View Contest Categories';
    case CreateContestCategories = 'Create Contest Categories';
    case DeleteAnyContestCategories = 'Delete Any Contest Categories';
    case UpdateAnyContestCategories = 'Update Any Contest Categories';

    public function getLabel(): string
    {
        return match ($this) {
            // Admin Panel
            self::ViewAdminPanel => 'مشاهده ادمین پنل',
            // Roles
            self::ViewAnyRoles => 'مشاهده همه نقش ها',
            self::CreateRoles => 'ایجاد نقش',
            self::UpdateAnyRoles => 'ویرایش هر نقش',
            self::DeleteAnyRoles => 'حذف هر نقش',
            // Permissions
            self::ViewAnyPermissions => 'مشاهده همه دسترسی ها',
            // Users
            self::ViewAnyUsers => 'مشاهده همه کاربر ها',
            self::ViewOwnedUsers => 'مشاهده حساب کاربری خود',
            self::UpdateAnyUsers => 'ویرایش هر کاربر',
            self::UpdateOwnedUsers => 'ویرایش حساب کاربری خود',
            self::CreateUsers => 'ایجاد کاربر',
            self::DeleteAnyUsers => 'حدف هر کاربر',
            // Reward Programs
            self::ViewAnyRewardPrograms => 'مشاهده همه خدمات',
            self::UpdateAnyRewardPrograms => 'ویرایش هر خدمت',
            self::CreateRewardPrograms => 'ایجاد خدمت',
            self::DeleteAnyRewardPrograms => 'حدف هر خدمت',
            // Reward Program Categories
            self::ViewAnyRewardProgramCategories => 'مشاهده همه دسته بندی های خدمات',
            self::UpdateAnyRewardProgramCategories => 'ویرایش هر دسته بندی خدمات',
            self::CreateRewardProgramCategories => 'ایجاد دسته بندی خدمات',
            self::DeleteAnyRewardProgramCategories => 'حدف هر دسته بندی خدمات',
            // Target Groups
            self::ViewAnyTargetGroups => ' همه گروه های هدف',
            self::UpdateAnyTargetGroups => 'ویرایش هر گروه هدف',
            self::CreateTargetGroups => 'ایجاد گروه هدف',
            self::DeleteAnyTargetGroups => 'حدف هر گروه هدف',
            // Event Program Categories
            self::ViewAnyEventProgramCategories => 'مشاهده همه دسته بندی های رویداد ها',
            self::UpdateAnyEventProgramCategories => 'ویرایش هر دسته بندی رویداد ها',
            self::CreateEventProgramCategories => 'ایجاد دسته بندی رویداد ها',
            self::DeleteAnyEventProgramCategories => 'حدف هر دسته بندی رویداد ها',
            // Event Programs
            self::ViewAnyEventPrograms => 'مشاهده همه رویداد ها',
            self::ViewOwnedEventPrograms => 'مشاهده رویداد های خود',
            self::CreateEventPrograms => 'ایجاد رویداد',
            self::UpdateAnyEventPrograms => 'ویرایش هر رویداد',
            self::UpdateOwnedEventPrograms => 'ویرایش رویداد های خود',
            self::DeleteAnyEventPrograms => 'حذف هر رویداد',
            self::DeleteOwnedEventPrograms => 'حذف رویداد های خود',
            // Banners
            self::ViewAnyBanners => 'مشاهده همه بنر ها',
            self::UpdateAnyBanners => 'ویرایش هر بنر',
            self::CreateBanners => 'ایجاد بنر',
            self::DeleteAnyBanners => 'حدف هر بنر',
            // Contests
            self::ViewAnyContests => 'مشاهده همه چالش ها',
            self::UpdateAnyContests => 'ویرایش هر چالش',
            self::CreateContests => 'ایجاد چالش',
            self::DeleteAnyContests => 'حدف هر چالش',
            // Event Program Categories
            self::ViewAnyContestCategories => 'مشاهده همه دسته بندی های چالش ها',
            self::UpdateAnyContestCategories => 'ویرایش هر دسته بندی چالش ها',
            self::CreateContestCategories => 'ایجاد دسته بندی چالش ها',
            self::DeleteAnyContestCategories => 'حدف هر دسته بندی چالش ها',
        };
    }
}
