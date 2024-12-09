import { cn } from '@/utils';
import React from 'react';
import ReactSelectMain from 'react-select';

type ReactSelectProps = React.ComponentProps<typeof ReactSelectMain> & {
  menuClassName?: string;
  hasError?: boolean;
};

export default function ReactSelect({
  className,
  hasError,
  menuClassName,
  ...props
}: ReactSelectProps) {
  return (
    <ReactSelectMain
      menuPlacement="auto"
      placeholder="انتخاب کنید ..."
      noOptionsMessage={() => 'گزینه ای موجود نیست.'}
      {...props}
      components={{ DropdownIndicator: () => null }}
      unstyled
      classNames={{
        container: () => cn(className, 'font-fa'),
        control: ({ isFocused, hasValue }) =>
          cn('select select-bordered', {
            'border-2 border-primary': isFocused,
            'h-auto': props.isMulti && hasValue,
            'border-error': hasError,
          }),
        placeholder: () => 'text-gray-600',
        indicatorsContainer: () => 'gap-1',
        clearIndicator: () => 'absolute left-7 btn btn-circle btn-ghost btn-sm size-5',
        dropdownIndicator: () => 'btn btn-circle btn-ghost btn-sm p-1',
        noOptionsMessage: () => 'py-4 font-display text-base',
        menu: () =>
          cn(
            'mt-1 min-h-[2rem] rounded-btn border border-base-300 bg-base-200 px-2 shadow',
            menuClassName,
          ),
        multiValue: () => 'm-1 rounded-btn bg-base-200 p-1 px-2 hover:bg-base-300',
        multiValueRemove: () => 'btn btn-circle btn-ghost btn-xs ml-1',
        option: ({ isFocused, isSelected }) =>
          cn('my-1 rounded-btn px-2 py-3 text-xs hover:cursor-pointer', {
            'bg-primary text-primary-content': isSelected,
            'bg-base-300 text-base-content': !isSelected && isFocused,
          }),
      }}
    />
  );
}
