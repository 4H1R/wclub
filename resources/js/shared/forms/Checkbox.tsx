import { cn } from '@/utils';
import get from 'lodash/get';
import { InputHTMLAttributes, useContext } from 'react';
import FieldWrapper, { FieldProps } from './FieldWrapper';
import { formContext } from './Form';

type CheckboxProps = Omit<FieldProps, 'children'> & {
  attributes?: InputHTMLAttributes<HTMLInputElement>;
  inputClassName?: string;
};

export default function Checkbox({
  attributes,
  inputClassName,
  className,
  ...props
}: CheckboxProps) {
  const { clearErrors, setData, data } = useContext(formContext);
  const value = get(data, props.name);

  return (
    <FieldWrapper
      {...props}
      className={cn('flex flex-row-reverse items-center justify-end gap-4', className)}
      label={{ ...props.label, className: 'w-auto' }}
    >
      {({ hasError, ...fieldProps }) => (
        <input
          {...fieldProps}
          {...attributes}
          type="checkbox"
          checked={value}
          onChange={(e) => {
            if (hasError) clearErrors(props.name);
            setData(props.name, e.target.value);
          }}
          className={cn('checkbox-primary checkbox !mt-0', inputClassName, {
            'checkbox-error': hasError,
          })}
        />
      )}
    </FieldWrapper>
  );
}
