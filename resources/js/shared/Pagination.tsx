import { useCurrentRoute } from '@/hooks';
import Button from '@/shared/forms/Button';
import { PaginatedCollection } from '@/types';
import { cn } from '@/utils';
import { router } from '@inertiajs/react';
import { digitsEnToFa } from '@persian-tools/persian-tools';

type PaginationProps = {
  data: PaginatedCollection<object>;
};

export default function Pagination({ data }: PaginationProps) {
  const currentRoute = useCurrentRoute();
  const handleChangePage = (page: string | number) => {
    router.get(currentRoute, { ...route().params, page }, { preserveState: true });
  };

  if (data.meta.total <= 0) return null;

  return (
    <div className="join col-span-full flex flex-wrap items-center justify-center gap-y-2">
      {data?.links.map((link) => (
        <Button
          onClick={() => {
            const url = new URL(link.url!);
            handleChangePage(url.searchParams.get('page')!);
          }}
          disabled={!link.url}
          key={link.label}
          className={cn('btn join-item', {
            'btn-primary': link.active,
          })}
        >
          {isNaN(parseInt(link.label, 10)) ? link.label : digitsEnToFa(link.label)}
        </Button>
      ))}
    </div>
  );
}
