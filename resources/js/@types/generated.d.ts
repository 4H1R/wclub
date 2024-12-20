declare namespace App.Data {
  export type ChartData = {
    date: string;
    aggregate: number;
  };
}
declare namespace App.Data.Banner {
  export type BannerData = {
    id: number;
    title: string;
    link: string;
    image: App.Data.Media.ImageData | null;
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
declare namespace App.Data.Contest {
  export type ContestData = {
    id: number;
    title: string;
    short_description: string | null;
    image: App.Data.Media.ImageData | null;
    min_participants: number | null;
    max_participants: number | null;
    started_at: string;
    finished_at: string;
    categories: Array<App.Data.Category.CategoryData>;
  };
  export type ContestFullData = {
    id: number;
    title: string;
    short_description: string | null;
    description: string;
    image: App.Data.Media.ImageData | null;
    min_participants: number | null;
    max_participants: number | null;
    has_registered: boolean;
    started_at: string;
    finished_at: string;
    categories: Array<App.Data.Category.CategoryData>;
  };
}
declare namespace App.Data.EventProgram {
  export type EventProgramData = {
    id: number;
    title: string;
    short_description: string | null;
    image: App.Data.Media.ImageData | null;
    min_participants: number | null;
    max_participants: number | null;
    started_at: string;
    finished_at: string;
    categories: Array<App.Data.Category.CategoryData>;
  };
  export type EventProgramFullData = {
    id: number;
    title: string;
    short_description: string | null;
    description: string;
    image: App.Data.Media.ImageData | null;
    min_participants: number | null;
    max_participants: number | null;
    started_at: string;
    finished_at: string;
    categories: Array<App.Data.Category.CategoryData>;
  };
}
declare namespace App.Data.Game {
  export type GameData = {
    title: string;
    slug: string;
    short_description: string | null;
    image: string;
  };
}
declare namespace App.Data.Garden {
  export type GardenData = {
    id: number;
    title: string;
    address: string;
    max_participants: number;
    images: Array<App.Data.Media.ImageData>;
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
    description: string;
    image: App.Data.Media.ImageData | null;
    categories: Array<App.Data.Category.CategoryData>;
  };
}
declare namespace App.Data.Series {
  export type SeriesData = {
    id: number;
    title: string;
    type: App.Enums.Series.SeriesTypeEnum;
    status: App.Enums.Series.SeriesStatusEnum;
    short_description: string;
    episodes_duration_seconds: number;
    image: App.Data.Media.ImageData | null;
    categories: Array<App.Data.Category.CategoryData>;
  };
  export type SeriesFaqData = {
    title: string;
    description: string;
  };
  export type SeriesFullData = {
    id: number;
    title: string;
    type: App.Enums.Series.SeriesTypeEnum;
    status: App.Enums.Series.SeriesStatusEnum;
    short_description: string;
    description: string;
    episodes_duration_seconds: number;
    episodes_count: number;
    owned_users_count: number;
    is_owned: boolean;
    chapters: Array<App.Data.SeriesChapter.SeriesChapterData>;
    faqs: Array<App.Data.Series.SeriesFaqData> | null;
    image: App.Data.Media.ImageData | null;
    categories: Array<App.Data.Category.CategoryData>;
    published_at: string;
  };
}
declare namespace App.Data.SeriesChapter {
  export type SeriesChapterData = {
    id: number;
    title: string;
    episodes: Array<App.Data.SeriesEpisode.SeriesEpisodeData>;
  };
}
declare namespace App.Data.SeriesEpisode {
  export type SeriesEpisodeData = {
    id: number;
    title: string;
    video_duration_seconds: number;
  };
  export type SeriesEpisodeFullData = {
    id: number;
    episode_number: number;
    chapter_id: number;
    title: string;
    description: string | null;
    video_duration_seconds: number;
    video: App.Data.Media.VideoData | null;
    created_at: string;
  };
}
declare namespace App.Data.Tag {
  export type TagData = {
    id: number;
    title: string;
  };
}
declare namespace App.Data.TargetGroup {
  export type TargetGroupData = {
    id: number;
    title: string;
    image: App.Data.Media.ImageData | null;
  };
}
declare namespace App.Data.User {
  export type AuthUserData = {
    id: number;
    first_name: string;
    last_name: string;
    score: number;
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
    'ViewOwnedUsers' = 'View Owned Users',
    'CreateUsers' = 'Create Users',
    'DeleteAnyUsers' = 'Delete Any Users',
    'UpdateAnyUsers' = 'Update Any Users',
    'UpdateOwnedUsers' = 'Update Owned Users',
    'ViewAnyRewardPrograms' = 'View Any Reward Programs',
    'CreateRewardPrograms' = 'Create Reward Programs',
    'DeleteAnyRewardPrograms' = 'Delete Any Reward Programs',
    'UpdateAnyRewardPrograms' = 'Update Any Reward Programs',
    'ViewAnyRewardProgramCategories' = 'View Any Reward Program Categories',
    'CreateRewardProgramCategories' = 'Create Reward Program Categories',
    'DeleteAnyRewardProgramCategories' = 'Delete Any Reward Program Categories',
    'UpdateAnyRewardProgramCategories' = 'Update Any Reward Program Categories',
    'ViewAnyTargetGroups' = 'View Any Target Groups',
    'CreateTargetGroups' = 'Create Target Groups',
    'DeleteAnyTargetGroups' = 'Delete Any Target Groups',
    'UpdateAnyTargetGroups' = 'Update Any Target Groups',
    'ViewAnyEventProgramCategories' = 'View Any Event Program Categories',
    'CreateEventProgramCategories' = 'Create Event Program Categories',
    'DeleteAnyEventProgramCategories' = 'Delete Any Event Program Categories',
    'UpdateAnyEventProgramCategories' = 'Update Any Event Program Categories',
    'ViewAnyEventPrograms' = 'View Any Event Programs',
    'ViewOwnedEventPrograms' = 'View Owned Event Programs',
    'CreateEventPrograms' = 'Create Event Programs',
    'DeleteAnyEventPrograms' = 'Delete Any Event Programs',
    'DeleteOwnedEventPrograms' = 'Delete Owned Event Programs',
    'UpdateAnyEventPrograms' = 'Update Any Event Programs',
    'UpdateOwnedEventPrograms' = 'Update Owned Event Programs',
    'ViewAnyBanners' = 'View Any Banners',
    'CreateBanners' = 'Create Banners',
    'DeleteAnyBanners' = 'Delete Any Banners',
    'UpdateAnyBanners' = 'Update Any Banners',
    'ViewAnyContests' = 'View Any Contests',
    'CreateContests' = 'Create Contests',
    'DeleteAnyContests' = 'Delete Any Contests',
    'UpdateAnyContests' = 'Update Any Contests',
    'ViewAnyContestCategories' = 'View Any Contest Categories',
    'CreateContestCategories' = 'Create Contest Categories',
    'DeleteAnyContestCategories' = 'Delete Any Contest Categories',
    'UpdateAnyContestCategories' = 'Update Any Contest Categories',
    'ViewAnySeries' = 'View Any Series',
    'CreateSeries' = 'Create Series',
    'DeleteAnySeries' = 'Delete Any Series',
    'UpdateAnySeries' = 'Update Any Series',
    'ViewAnySeriesCategories' = 'View Any Series Categories',
    'CreateSeriesCategories' = 'Create Series Categories',
    'DeleteAnySeriesCategories' = 'Delete Any Series Categories',
    'UpdateAnySeriesCategories' = 'Update Any Series Categories',
    'ViewAnyContactUs' = 'View Any Contact Us',
    'DeleteAnyContactUs' = 'Delete Any Contact Us',
    'ViewAnyGardens' = 'View Any Gardens',
    'CreateGardens' = 'Create Gardens',
    'DeleteAnyGardens' = 'Delete Any Gardens',
    'UpdateAnyGardens' = 'Update Any Gardens',
  }
  export enum RoleEnum {
    'SuperAdmin' = 'Super Admin',
    'Test' = 'Test',
  }
}
declare namespace App.Enums.Series {
  export enum SeriesStatusEnum {
    'InProgress' = 'IN_PROGRESS',
    'Finished' = 'FINISHED',
  }
  export enum SeriesTypeEnum {
    'Free' = 'FREE',
  }
}
