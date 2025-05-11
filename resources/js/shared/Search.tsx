import { useCurrentRoute } from '@/hooks';
import Button from '@/shared/forms/Button';
import { cn } from '@/utils';
import { router } from '@inertiajs/react';
import get from 'lodash/get';
import set from 'lodash/set';
import React, { useState } from 'react';
import { HiOutlineMagnifyingGlass, HiOutlineXMark } from 'react-icons/hi2';
import { useDebouncedCallback } from 'use-debounce';

type SearchInputProps = {
  inputProps?: React.InputHTMLAttributes<HTMLInputElement>;
  parentProps?: React.InputHTMLAttributes<HTMLDivElement>;
};

type BaseSearchProps = SearchInputProps & {
  search: string;
  setSearch: (search: string) => void;
  isSearching?: boolean;
};

export function BaseSearch({
  inputProps,
  parentProps,
  search,
  setSearch,
  isSearching,
}: BaseSearchProps) {
  return (
    <div {...parentProps} className={cn('relative', parentProps?.className)}>
      <input
        placeholder="جست و جو ..."
        {...inputProps}
        value={search}
        onChange={(e) => setSearch(e.target.value)}
        type="text"
        className={cn(
          'input input-bordered w-full pl-10',
          { 'pr-10': isSearching },
          inputProps?.className,
        )}
      />
      {isSearching && (
        <div className="loading loading-spinner absolute right-3 top-3 text-base-content/80" />
      )}
      {search ? (
        <Button
          onClick={() => setSearch('')}
          className="btn btn-circle btn-ghost btn-sm absolute left-2 top-2"
        >
          <HiOutlineXMark className="size-6 text-base-content/50" />
        </Button>
      ) : (
        <HiOutlineMagnifyingGlass className="absolute left-3 top-3 size-6 text-base-content/50" />
      )}
    </div>
  );
}

type SearchProps = SearchInputProps & {
  url?: string;
};

export default function Search({ url, ...props }: SearchProps) {
  const currentRoute = useCurrentRoute();
  const [isSearching, setIsSearching] = useState(false);
  const [value, setValue] = useState(get(route().params, 'filter.query', ''));
  const setDebouncedValue = useDebouncedCallback((debouncedValue: string) => {
    setIsSearching(true);
    router.get(
      url ?? currentRoute,
      set({ ...route().params, page: 1 }, 'filter.query', debouncedValue || undefined),
      {
        preserveState: true,
        preserveScroll: true,
        onFinish: () => setIsSearching(false),
      },
    );
  }, 1000);

  return (
    <BaseSearch
      parentProps={{ className: 'w-full md:w-auto' }}
      {...props}
      isSearching={isSearching}
      search={value}
      setSearch={(newSearch) => {
        setValue(newSearch);
        setDebouncedValue(newSearch);
      }}
    />
  );
}
