type TRecord = Record<string, unknown>;

export type PageProps<T extends TRecord = TRecord> = T & {
  auth: {
    user: App.Data.User.AuthUserData | null;
  };
  target_groups: App.Data.TargetGroup.TargetGroupData[];
  active_target_group_id: number;
  event_program_categories: App.Data.Category.CategoryData[];
  topics: App.Data.Topic.TopicData[];
};
