import { cn } from '@/utils';
import React, { useContext } from 'react';
import ErrorMessage from './ErrorMessage';
import { formContext } from './Form';
import Label from './Label';

export type FieldProps = {
  name: string;
  isRequired: boolean;
  label: { text: string; bottom?: { left?: string; right?: string }; className?: string };
  children:
    | React.ReactNode
    | ((props: {
        hasError: boolean;
        name: string;
        id: string;
        className?: string;
      }) => React.ReactNode);
  info?: string;
  className?: string;
  attributes?: object;
  inputClassName?: string;
};

export default function FieldWrapper({
  name,
  label,
  info,
  isRequired,
  className,
  children,
}: FieldProps) {
  const { errors } = useContext(formContext);
  const hasError = Boolean(errors[name]);

  return (
    <div className={cn('relative w-full space-y-2', className)}>
      <Label
        className={label.className}
        info={info}
        isRequired={isRequired}
        htmlFor={name}
        label={label.text}
      />
      {typeof children === 'function' ? children({ hasError, name, id: name }) : children}
      {label.bottom && (
        <div className="label font-medium">
          {label.bottom.left && <span className="label-text-alt">{label.bottom.left}</span>}
          {label.bottom.right && <span className="label-text-alt">{label.bottom.right}</span>}
        </div>
      )}
      <ErrorMessage name={name} />
    </div>
  );
}
