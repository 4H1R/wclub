import { cn } from '@/utils';
import { useContext } from 'react';
import FieldWrapper, { FieldProps } from './FieldWrapper';
import { formContext } from './Form';

type ToggleProps = Omit<FieldProps, 'children'>;

export default function Toggle({ ...props }: ToggleProps) {
  const { clearErrors, setData, data } = useContext(formContext);

  return (
    <FieldWrapper {...props}>
      {({ hasError, ...fieldProps }) => (
        <input
          {...fieldProps}
          {...props.attributes}
          checked={data[props.name] as boolean}
          onChange={(e) => {
            if (hasError) clearErrors(props.name);
            setData(props.name, e.target.checked);
          }}
          type="checkbox"
          className={cn('toggle toggle-primary toggle-md block', { 'toggle-error': hasError })}
        />
      )}
    </FieldWrapper>
  );
}
