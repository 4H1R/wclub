declare namespace App.Data {
  export type ChartData = {
    date: string;
    aggregate: number;
  };
}
declare namespace App.Data.Category {
  export type CategoryData = {
    id: number;
    title: string;
  };
}
declare namespace App.Data.ContactUs {
  export type RequestContactUsData = {
    full_name: string;
    email: string | null;
    phone: string;
    title: string;
    description: string;
  };
}
declare namespace App.Data.Media {
  export type ImageData = {
    id: number;
    original_url: string;
  };
  export type VideoData = {
    id: number;
    mime_type: string;
    url: string | null;
  };
}
declare namespace App.Data.RewardProgram {
  export type RewardProgramData = {
    id: number;
    title: string;
    short_description: string | null;
    required_score: number;
    image: App.Data.Media.ImageData | null;
    categories: Array<App.Data.Category.CategoryData>;
  };
  export type RewardProgramFullData = {
    id: number;
    title: string;
    short_description: string | null;
    required_score: number;
    content: string;
    image: App.Data.Media.ImageData | null;
    categories: Array<App.Data.Category.CategoryData>;
  };
}
declare namespace App.Data.Tag {
  export type TagData = {
    id: number;
    title: string;
  };
}
declare namespace App.Data.User {
  export type AuthUserData = {
    id: number;
    first_name: string;
    last_name: string;
    email: string | null;
    phone: string | null;
    email_verified_at: string | null;
    phone_verified_at: string | null;
    can_access_admin_panel: boolean;
    created_at: string;
    updated_at: string;
  };
  export type UserData = {
    id: number;
    first_name: string;
    last_name: string;
    image: App.Data.Media.ImageData | null;
    created_at: string;
  };
}
declare namespace App.Enums {
  export enum GenderEnum {
    'Male' = 'MALE',
    'Female' = 'FEMALE',
  }
  export enum PermissionEnum {
    'ViewAdminPanel' = 'View Admin Panel',
    'ViewAnyRoles' = 'View Any Roles',
    'CreateRoles' = 'Create Roles',
    'UpdateAnyRoles' = 'Update Any Roles',
    'DeleteAnyRoles' = 'Delete Any Roles',
    'ViewAnyPermissions' = 'View Any Permissions',
    'ViewAnyUsers' = 'View Any Users',
    'ViewUser' = 'View User',
    'CreateUsers' = 'Create Users',
    'DeleteAnyUsers' = 'Delete Any Users',
    'UpdateAnyUsers' = 'Update Any Users',
    'UpdateUser' = 'Update User',
    'ViewAnyRewardPrograms' = 'View Reward Programs',
    'CreateRewardPrograms' = 'Create Reward Programs',
    'DeleteAnyRewardPrograms' = 'Delete Any Reward Programs',
    'UpdateAnyRewardPrograms' = 'Update Any Reward Programs',
    'ViewAnyRewardProgramCategories' = 'View Reward Program Categories',
    'CreateRewardProgramCategories' = 'Create Reward Program Categories',
    'DeleteAnyRewardProgramCategories' = 'Delete Any Reward Program Categories',
    'UpdateAnyRewardProgramCategories' = 'Update Any Reward Program Categories',
    'ViewAnyTargetGroups' = 'View Reward Target Groups',
    'CreateTargetGroups' = 'Create Reward Target Groups',
    'DeleteAnyTargetGroups' = 'Delete Any Reward Target Groups',
    'UpdateAnyTargetGroups' = 'Update Any Reward Target Groups',
  }
  export enum RoleEnum {
    'SuperAdmin' = 'Super Admin',
  }
}
