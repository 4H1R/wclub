import Button from '@/shared/forms/Button';
import { PaginatedCollection } from '@/types';
import { cn } from '@/utils';
import { router, usePage } from '@inertiajs/react';

type PaginationProps = {
  data: PaginatedCollection<object>;
};

export default function Pagination({ data }: PaginationProps) {
  const currentRoute = usePage().url.split('?')[0];
  const handleChangePage = (page: string | number) => {
    router.get(currentRoute, { ...route().params, page }, { preserveState: true });
  };

  if (data.meta.total <= 0) return null;

  return (
    <div className="join col-span-full flex items-center justify-center">
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
          {link.label}
        </Button>
      ))}
    </div>
  );
}
