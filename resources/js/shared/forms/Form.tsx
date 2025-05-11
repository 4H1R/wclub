/* eslint-disable @typescript-eslint/no-explicit-any */
import { THasChildren } from '@/types';
import { cn } from '@/utils';
import { useForm } from '@inertiajs/react';
import React, { createContext } from 'react';

type TFormRecord = Record<string, any>;
export type TInertiaForm<TForm extends TFormRecord> = ReturnType<typeof useForm<TForm>>;

export const formContext = createContext<TInertiaForm<TFormRecord>>(
  {} as TInertiaForm<TFormRecord>,
);

type FormProps<TForm extends TFormRecord> = THasChildren &
  React.FormHTMLAttributes<HTMLFormElement> & {
    onSubmit: () => void;
    form: TInertiaForm<TForm>;
    styleMode: 'grid' | 'base' | 'none';
  };

export default function Form<TForm extends TFormRecord>({
  children,
  onSubmit,
  className,
  form,
  styleMode,
  ...props
}: FormProps<TForm>) {
  return (
    <form
      {...props}
      className={cn(
        {
          'space-y-4': styleMode === 'base',
          'grid grid-cols-1 gap-4 md:grid-cols-2': styleMode === 'grid',
        },
        className,
      )}
      onSubmit={(e) => {
        e.preventDefault();
        onSubmit();
      }}
    >
      <formContext.Provider value={form as any}>{children}</formContext.Provider>
    </form>
  );
}
