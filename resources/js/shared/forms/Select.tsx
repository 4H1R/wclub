import { IOption } from '@/interfaces';
import { cn } from '@/utils';
import get from 'lodash/get';
import { InputHTMLAttributes, useContext } from 'react';
import FieldWrapper, { FieldProps } from './FieldWrapper';
import { formContext } from './Form';

type SelectProps = Omit<FieldProps, 'children'> & {
  attributes?: InputHTMLAttributes<HTMLSelectElement>;
  selectClassName?: string;
  options: IOption<string>[];
};

export default function Select({ attributes, selectClassName, options, ...props }: SelectProps) {
  const { clearErrors, setData, data } = useContext(formContext);
  const value = get(data, props.name);

  return (
    <FieldWrapper {...props}>
      {({ hasError, ...fieldProps }) => (
        <select
          {...attributes}
          {...fieldProps}
          value={value as string}
          onChange={(e) => {
            if (hasError) clearErrors(props.name);
            setData(props.name, e.target.value);
          }}
          className={cn('select select-bordered w-full', selectClassName, {
            'select-error': hasError,
          })}
        >
          <option value="">لطفا یک گزینه را انتخاب کنید</option>
          {options.map((option) => (
            <option key={option.value} value={option.value}>
              {option.label}
            </option>
          ))}
        </select>
      )}
    </FieldWrapper>
  );
}
