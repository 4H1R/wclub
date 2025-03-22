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
    short_description: string;
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
    short_description: string;
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
declare namespace App.Data.Coupon {
  export type CouponData = {
    id: number;
    user_id: number;
    title: string;
    code: string;
    type: App.Enums.Coupon.CouponTypeEnum;
    amount: number | null;
    percentage: number | null;
    max_percentage_amount: number | null;
    expired_at: string;
  };
}
declare namespace App.Data.EventProgram {
  export type EventProgramData = {
    id: number;
    title: string;
    short_description: string;
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
    short_description: string;
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
    image_type: string;
  };
}
declare namespace App.Data.Garden {
  export type GardenData = {
    id: number;
    title: string;
    address: string;
    max_participants: number;
    image: App.Data.Media.ImageData | null;
  };
  export type GardenFullData = {
    id: number;
    title: string;
    description: string;
    address: string;
    longitude: number;
    latitude: number;
    max_participants: number;
    images: Array<App.Data.Media.ImageData>;
  };
}
declare namespace App.Data.Honeypot {
  export type HoneypotData = {
    name_field_name: string;
    valid_from_field_name: string;
    encrypted_valid_from: string;
    enabled: boolean;
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
declare namespace App.Data.News {
  export type NewsData = {
    id: number;
    title: string;
    short_description: string;
    image: App.Data.Media.ImageData | null;
    categories: Array<App.Data.Category.CategoryData>;
  };
  export type NewsFullData = {
    id: number;
    title: string;
    short_description: string;
    description: string;
    image: App.Data.Media.ImageData | null;
    categories: Array<App.Data.Category.CategoryData>;
  };
}
declare namespace App.Data.RewardProgram {
  export type RewardProgramData = {
    id: number;
    title: string;
    short_description: string;
    required_score: number;
    image: App.Data.Media.ImageData | null;
    categories: Array<App.Data.Category.CategoryData>;
  };
  export type RewardProgramFullData = {
    id: number;
    title: string;
    short_description: string;
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
    hash_id: string;
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
  export type GenderEnum = 'MALE' | 'FEMALE';
  export type PermissionEnum =
    | 'View Admin Panel'
    | 'View Any Roles'
    | 'Create Roles'
    | 'Update Any Roles'
    | 'Delete Any Roles'
    | 'View Any Permissions'
    | 'View Any Users'
    | 'View Owned Users'
    | 'Create Users'
    | 'Delete Any Users'
    | 'Update Any Users'
    | 'Update Owned Users'
    | 'View Any Reward Programs'
    | 'Create Reward Programs'
    | 'Delete Any Reward Programs'
    | 'Update Any Reward Programs'
    | 'View Any Reward Program Categories'
    | 'Create Reward Program Categories'
    | 'Delete Any Reward Program Categories'
    | 'Update Any Reward Program Categories'
    | 'View Any Target Groups'
    | 'Create Target Groups'
    | 'Delete Any Target Groups'
    | 'Update Any Target Groups'
    | 'View Any Event Program Categories'
    | 'Create Event Program Categories'
    | 'Delete Any Event Program Categories'
    | 'Update Any Event Program Categories'
    | 'View Any Event Programs'
    | 'View Owned Event Programs'
    | 'Create Event Programs'
    | 'Delete Any Event Programs'
    | 'Delete Owned Event Programs'
    | 'Update Any Event Programs'
    | 'Update Owned Event Programs'
    | 'View Any Banners'
    | 'Create Banners'
    | 'Delete Any Banners'
    | 'Update Any Banners'
    | 'View Any Contests'
    | 'Create Contests'
    | 'Delete Any Contests'
    | 'Update Any Contests'
    | 'View Any Contest Categories'
    | 'Create Contest Categories'
    | 'Delete Any Contest Categories'
    | 'Update Any Contest Categories'
    | 'View Any Series'
    | 'Create Series'
    | 'Delete Any Series'
    | 'Update Any Series'
    | 'View Any Series Categories'
    | 'Create Series Categories'
    | 'Delete Any Series Categories'
    | 'Update Any Series Categories'
    | 'View Any Contact Us'
    | 'Delete Any Contact Us'
    | 'View Any Gardens'
    | 'Create Gardens'
    | 'Delete Any Gardens'
    | 'Update Any Gardens'
    | 'View Any News'
    | 'Create News'
    | 'Delete Any News'
    | 'Update Any News'
    | 'View Any Coupons'
    | 'Create Coupons'
    | 'Delete Any Coupons'
    | 'Update Any Coupons';
  export type RoleEnum = 'Super Admin' | 'Test';
}
declare namespace App.Enums.Coupon {
  export type CouponTypeEnum = 'AMOUNT' | 'PERCENTAGE';
}
declare namespace App.Enums.Series {
  export type SeriesPresentationModeEnum = 'IN_PERSON' | 'ONLINE' | 'PLATFORM';
  export type SeriesStatusEnum = 'IN_PROGRESS' | 'FINISHED';
  export type SeriesTypeEnum = 'FREE';
}
