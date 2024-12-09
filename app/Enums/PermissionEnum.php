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
    case ViewUser = 'View User';
    case CreateUsers = 'Create Users';
    case DeleteAnyUsers = 'Delete Any Users';
    case UpdateAnyUsers = 'Update Any Users';
    case UpdateUser = 'Update User';
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
            self::ViewUser => 'مشاهده حساب کاربری خود',
            self::UpdateAnyUsers => 'ویرایش هر کاربر',
            self::UpdateUser => 'ویرایش حساب کاربری خود',
            self::CreateUsers => 'ایجاد کاربر',
            self::DeleteAnyUsers => 'حدف هر کاربر',
            // Reward Programs
            self::ViewAnyRewardPrograms => 'مشاهده همه خدمات',
            self::UpdateAnyRewardPrograms => 'ویرایش هر خدمت',
            self::CreateRewardPrograms => 'ایجاد خدمت',
            self::DeleteAnyRewardPrograms => 'حدف هر خدمت',
            // Reward Program Categories
            self::ViewAnyRewardProgramCategories => 'مشاهده همه دسته بندی ها خدمات',
            self::UpdateAnyRewardProgramCategories => 'ویرایش هر دسته بندی خدمات',
            self::CreateRewardProgramCategories => 'ایجاد دسته بندی خدمات',
            self::DeleteAnyRewardProgramCategories => 'حدف هر دسته بندی خدمات',
        };
    }
}
