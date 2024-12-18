export enum SeriesStatusEnum {
  'InProgress' = 'IN_PROGRESS',
  'Finished' = 'FINISHED',
}
export enum SeriesTypeEnum {
  'Free' = 'FREE',
}

export const seriesStatusTranslation: Record<App.Enums.Series.SeriesStatusEnum, string> = {
  [SeriesStatusEnum.Finished]: 'تکمیل ظبط',
  [SeriesStatusEnum.InProgress]: 'در حال ضبط',
};
