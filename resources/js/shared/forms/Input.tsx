import Button from '@/shared/forms/Button';
import { cn } from '@/utils';
import get from 'lodash/get';
import { InputHTMLAttributes, useContext, useState } from 'react';
import { HiOutlineEye, HiOutlineEyeSlash } from 'react-icons/hi2';
import FieldWrapper, { FieldProps } from './FieldWrapper';
import { formContext } from './Form';

type InputProps = Omit<FieldProps, 'children'> & {
  attributes?: InputHTMLAttributes<HTMLInputElement>;
  inputClassName?: string;
};

export default function Input({ attributes, inputClassName, ...props }: InputProps) {
  const [showPassword, setShowPassword] = useState(false);
  const { clearErrors, setData, data } = useContext(formContext);

  const value = get(data, props.name);
  const Icon = showPassword ? HiOutlineEyeSlash : HiOutlineEye;
  const isPassword = attributes?.type === 'password';

  const handleToggleShowPassword = () => {
    setShowPassword((prev) => !prev);
  };

  return (
    <FieldWrapper {...props}>
      {({ hasError, ...fieldProps }) => (
        <>
          <input
            {...fieldProps}
            {...attributes}
            type={isPassword ? (showPassword ? 'text' : 'password') : attributes?.type}
            value={value}
            onChange={(e) => {
              if (hasError) clearErrors(props.name);
              setData(props.name, e.target.value);
            }}
            className={cn('input input-bordered w-full', inputClassName, {
              'input-error': hasError,
            })}
          />
          {isPassword && (
            <Button
              onClick={handleToggleShowPassword}
              className="btn btn-circle btn-ghost btn-sm absolute left-2 top-8"
            >
              <Icon className="h-6 w-6" />
            </Button>
          )}
        </>
      )}
    </FieldWrapper>
  );
}

type InputListsProps = {
  fields: InputProps[];
};

export function InputLists({ fields }: InputListsProps) {
  return fields.map((input) => <Input key={input.name} {...input} />);
}
