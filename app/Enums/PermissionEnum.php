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
    case ViewAnyRewardPrograms = 'View Any Reward Programs';
    case CreateRewardPrograms = 'Create Reward Programs';
    case DeleteAnyRewardPrograms = 'Delete Any Reward Programs';
    case UpdateAnyRewardPrograms = 'Update Any Reward Programs';
    // Reward Program Categories
    case ViewAnyRewardProgramCategories = 'View Any Reward Program Categories';
    case CreateRewardProgramCategories = 'Create Reward Program Categories';
    case DeleteAnyRewardProgramCategories = 'Delete Any Reward Program Categories';
    case UpdateAnyRewardProgramCategories = 'Update Any Reward Program Categories';
    // Target Groups
    case ViewAnyTargetGroups = 'View Any Target Groups';
    case CreateTargetGroups = 'Create Target Groups';
    case DeleteAnyTargetGroups = 'Delete Any Target Groups';
    case UpdateAnyTargetGroups = 'Update Any Target Groups';
    // Event Program Categories
    case ViewAnyEventProgramCategories = 'View Any Event Program Categories';
    case CreateEventProgramCategories = 'Create Event Program Categories';
    case DeleteAnyEventProgramCategories = 'Delete Any Event Program Categories';
    case UpdateAnyEventProgramCategories = 'Update Any Event Program Categories';
    // Event Programs
    case ViewAnyEventPrograms = 'View Any Event Programs';
    case ViewOwnedEventPrograms = 'View Owned Event Programs';
    case CreateEventPrograms = 'Create Event Programs';
    case DeleteAnyEventPrograms = 'Delete Any Event Programs';
    case DeleteOwnedEventPrograms = 'Delete Owned Event Programs';
    case UpdateAnyEventPrograms = 'Update Any Event Programs';
    case UpdateOwnedEventPrograms = 'Update Owned Event Programs';
    // Banners
    case ViewAnyBanners = 'View Any Banners';
    case CreateBanners = 'Create Banners';
    case DeleteAnyBanners = 'Delete Any Banners';
    case UpdateAnyBanners = 'Update Any Banners';
    // Contests
    case ViewAnyContests = 'View Any Contests';
    case CreateContests = 'Create Contests';
    case DeleteAnyContests = 'Delete Any Contests';
    case UpdateAnyContests = 'Update Any Contests';
    // Contest Categories
    case ViewAnyContestCategories = 'View Any Contest Categories';
    case CreateContestCategories = 'Create Contest Categories';
    case DeleteAnyContestCategories = 'Delete Any Contest Categories';
    case UpdateAnyContestCategories = 'Update Any Contest Categories';
    // Series
    case ViewAnySeries = 'View Any Series';
    case CreateSeries = 'Create Series';
    case DeleteAnySeries = 'Delete Any Series';
    case UpdateAnySeries = 'Update Any Series';
    // Series Categories
    case ViewAnySeriesCategories = 'View Any Series Categories';
    case CreateSeriesCategories = 'Create Series Categories';
    case DeleteAnySeriesCategories = 'Delete Any Series Categories';
    case UpdateAnySeriesCategories = 'Update Any Series Categories';
    // ContactUs
    case ViewAnyContactUs = 'View Any Contact Us';
    case DeleteAnyContactUs = 'Delete Any Contact Us';
    // Gardens
    case ViewAnyGardens = 'View Any Gardens';
    case CreateGardens = 'Create Gardens';
    case DeleteAnyGardens = 'Delete Any Gardens';
    case UpdateAnyGardens = 'Update Any Gardens';
    // News
    case ViewAnyNews = 'View Any News';
    case CreateNews = 'Create News';
    case DeleteAnyNews = 'Delete Any News';
    case UpdateAnyNews = 'Update Any News';
    // Coupons
    case ViewAnyCoupons = 'View Any Coupons';
    case CreateCoupons = 'Create Coupons';
    case DeleteAnyCoupons = 'Delete Any Coupons';
    case UpdateAnyCoupons = 'Update Any Coupons';
    // Orders
    case ViewAnyOrders = 'View Any Orders';
    case CreateOrders = 'Create Orders';
    case DeleteAnyOrders = 'Delete Any Orders';
    case UpdateAnyOrders = 'Update Any Orders';
    // Transactions
    case ViewAnyTransactions = 'View Any Transactions';
    case CreateTransactions = 'Create Transactions';
    case DeleteAnyTransactions = 'Delete Any Transactions';
    case UpdateAnyTransactions = 'Update Any Transactions';
    // Faqs
    case ViewAnyFaqs = 'View Any Faqs';
    case CreateFaqs = 'Create Faqs';
    case DeleteAnyFaqs = 'Delete Any Faqs';
    case UpdateAnyFaqs = 'Update Any Faqs';
    // Hn Images
    case ViewAnyHnImages = 'View Any Hn Images';
    case CreateHnImages = 'Create Hn Images';
    case DeleteAnyHnImages = 'Delete Any Hn Images';
    case UpdateAnyHnImages = 'Update Any Hn Images';
    // Hn Texts
    case ViewAnyHnTexts = 'View Any Hn Texts';
    case CreateHnTexts = 'Create Hn Texts';
    case DeleteAnyHnTexts = 'Delete Any Hn Texts';
    case UpdateAnyHnTexts = 'Update Any Hn Texts';
    // Question Forms
    case ViewAnyQuestionForms = 'View Any Question Forms';
    case CreateQuestionForms = 'Create Question Forms';
    case UpdateAnyQuestionForms = 'Update Any Question Forms';
    case DeleteAnyQuestionForms = 'Delete Any Question Forms';

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
            // Contest Categories
            self::ViewAnyContestCategories => 'مشاهده همه دسته بندی های چالش ها',
            self::UpdateAnyContestCategories => 'ویرایش هر دسته بندی چالش ها',
            self::CreateContestCategories => 'ایجاد دسته بندی چالش ها',
            self::DeleteAnyContestCategories => 'حدف هر دسته بندی چالش ها',
            // Series
            self::ViewAnySeries => 'مشاهده همه دوره ها',
            self::UpdateAnySeries => 'ویرایش هر دوره',
            self::CreateSeries => 'ایجاد دوره',
            self::DeleteAnySeries => 'حدف هر دوره',
            // Series Categories
            self::ViewAnySeriesCategories => 'مشاهده همه دسته بندی های دوره ها',
            self::UpdateAnySeriesCategories => 'ویرایش هر دسته بندی دوره ها',
            self::CreateSeriesCategories => 'ایجاد دسته بندی دوره ها',
            self::DeleteAnySeriesCategories => 'حدف هر دسته بندی دوره ها',
            // Contact Us
            self::ViewAnyContactUs => 'مشاهده همه تماس با ما ها',
            self::DeleteAnyContactUs => 'حذف هر تماس با ما',
            // Gardens
            self::ViewAnyGardens => 'مشاهده همه باغ های بانوان',
            self::UpdateAnyGardens => 'ویرایش هر باغ بانوان',
            self::CreateGardens => 'ایجاد باغ بانوان',
            self::DeleteAnyGardens => 'حدف هر باغ بانوان',
            // News
            self::ViewAnyNews => 'مشاهده همه اخبار',
            self::UpdateAnyNews => 'ویرایش هر خبر',
            self::CreateNews => 'ایجاد خبر',
            self::DeleteAnyNews => 'حدف هر خبر',
            // Coupons
            self::ViewAnyCoupons => 'مشاهده همه کد های تخفیف',
            self::UpdateAnyCoupons => 'ویرایش هر کد تخفیف',
            self::CreateCoupons => 'ایجاد کد تخفیف',
            self::DeleteAnyCoupons => 'حدف هر کد تخفیف',
            // Orders
            self::ViewAnyOrders => 'مشاهده همه سفارشات',
            self::UpdateAnyOrders => 'ویرایش هر سفارش',
            self::CreateOrders => 'ایجاد سفارش',
            self::DeleteAnyOrders => 'حدف هر سفارش',
            // Transactions
            self::ViewAnyTransactions => 'مشاهده همه تراکنش ها',
            self::UpdateAnyTransactions => 'ویرایش هر تراکنش',
            self::CreateTransactions => 'ایجاد تراکنش',
            self::DeleteAnyTransactions => 'حدف هر تراکنش',
            // Faqs
            self::ViewAnyFaqs => 'مشاهده همه پرسش و پاسخ ها',
            self::UpdateAnyFaqs => 'ویرایش هر پرسش و پاسخ',
            self::CreateFaqs => 'ایجاد پرسش و پاسخ',
            self::DeleteAnyFaqs => 'حدف هر پرسش و پاسخ',
            // Hn Images
            self::ViewAnyHnImages => 'مشاهده همه تصاویر هدیه نگار',
            self::UpdateAnyHnImages => 'ویرایش هر تصویر هدیه نگار',
            self::CreateHnImages => 'ایجاد تصویر هدیه نگار',
            self::DeleteAnyHnImages => 'حدف هر تصویر هدیه نگار',
            // Hn Texts
            self::ViewAnyHnTexts => 'مشاهده همه متن های هدیه نگار',
            self::UpdateAnyHnTexts => 'ویرایش هر متن هدیه نگار',
            self::CreateHnTexts => 'ایجاد متن هدیه نگار',
            self::DeleteAnyHnTexts => 'حدف هر متن هدیه نگار',
            // Question Forms
            self::ViewAnyQuestionForms => 'مشاهده همه فرم پرسش ها',
            self::UpdateAnyQuestionForms => 'ویرایش هر فرم پرسش',
            self::CreateQuestionForms => 'ایجاد فرم پرسش',
            self::DeleteAnyQuestionForms => 'حدف هر فرم پرسش',
        };
    }
}
