export enum SeriesStatusEnum {
  'InProgress' = 'IN_PROGRESS',
  'Finished' = 'FINISHED',
}

export const seriesStatusTranslation: Record<App.Enums.Series.SeriesStatusEnum, string> = {
  [SeriesStatusEnum.Finished]: 'تکمیل ظبط',
  [SeriesStatusEnum.InProgress]: 'در حال ضبط',
};
