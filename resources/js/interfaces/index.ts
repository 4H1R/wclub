export interface IOption<T> {
  value: T;
  label: string;
}

export interface IUnprocessableEntity<T extends string = string> {
  message: string;
  errors: Record<T, string[]>;
}
