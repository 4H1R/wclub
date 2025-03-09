/* eslint-disable @typescript-eslint/no-explicit-any */
import { THasChildren } from '@/types';
import { cn } from '@/utils';
import { useForm } from '@inertiajs/react';
import React, { createContext } from 'react';

export type TInertiaForm<TForm extends Record<string, any>> = ReturnType<typeof useForm<TForm>>;

export const formContext = createContext<TInertiaForm<any>>({} as any);

type FormProps<TForm extends object> = THasChildren &
  React.FormHTMLAttributes<HTMLFormElement> & {
    onSubmit: () => void;
    form: TInertiaForm<TForm>;
    styleMode: 'grid' | 'base' | 'none';
  };

export default function Form<TForm extends Record<string, unknown>>({
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
      <formContext.Provider value={form}>{children}</formContext.Provider>
    </form>
  );
}
