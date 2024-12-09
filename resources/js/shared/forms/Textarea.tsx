import { cn } from '@/utils';
import get from 'lodash/get';
import { TextareaHTMLAttributes, useContext } from 'react';
import FieldWrapper, { FieldProps } from './FieldWrapper';
import { formContext } from './Form';

type InputProps = Omit<FieldProps, 'children'> & {
  attributes?: TextareaHTMLAttributes<HTMLTextAreaElement>;
  textareaClassName?: string;
};

export default function Textarea({ attributes, textareaClassName, ...props }: InputProps) {
  const { clearErrors, setData, data } = useContext(formContext);
  const value = get(data, props.name);

  return (
    <FieldWrapper {...props}>
      {({ hasError, ...fieldProps }) => (
        <textarea
          {...fieldProps}
          {...attributes}
          value={value}
          onChange={(e) => {
            if (hasError) clearErrors(props.name);
            setData(props.name, e.target.value);
          }}
          className={cn('textarea textarea-bordered w-full', textareaClassName, {
            'textarea-error': hasError,
          })}
        />
      )}
    </FieldWrapper>
  );
}
