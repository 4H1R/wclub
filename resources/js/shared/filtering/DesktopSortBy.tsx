import { IOption } from '@/interfaces';
import { cn } from '@/utils';
import { router } from '@inertiajs/react';
import get from 'lodash/get';
import { GoSortDesc } from 'react-icons/go';
import Button from '../forms/Button';

type DesktopSortBy = {
  options: IOption<string>[];
};
export default function DesktopSortBy({ options }: DesktopSortBy) {
  const currentSort = get(route().params, 'sort', options.at(0)?.value);

  const handleSort = (sort: IOption<string>) => {
    router.get(
      route(route().current() as string, { ...route().params, page: 1, sort: sort.value }),
      undefined,
      { preserveState: true },
    );
  };

  return (
    <div className="hidden items-center gap-4 text-sm lg:flex">
      <div className="flex items-center gap-2">
        <GoSortDesc className="size-6" />
        <span className="font-bold">مرتب سازی:</span>
      </div>
      {options.map((sort) => (
        <Button
          onClick={() => handleSort(sort)}
          className={cn('min-w-fit text-base-content/80 hover:underline', {
            'font-medium text-secondary-solo': currentSort === sort.value,
          })}
          key={sort.label}
        >
          {sort.label}
        </Button>
      ))}
    </div>
  );
}
