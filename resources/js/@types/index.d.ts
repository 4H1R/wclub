type TRecord = Record<string, unknown>;

export type PageProps<T extends TRecord = TRecord> = T & {
  auth: {
    user: App.Data.User.AuthUserData | null;
  };
};
