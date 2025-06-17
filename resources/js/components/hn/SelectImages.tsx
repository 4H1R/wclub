import Button from '@/shared/forms/Button';
import Image from '@/shared/images/Image';
import { PaginatedCollection } from '@/types';
import { chunk } from '@/utils';
import { router } from '@inertiajs/react';
import React from 'react';

type SelectImagesProps = {
  onSelect: (data: App.Data.Hn.HnImageData) => void;
  data: PaginatedCollection<App.Data.Hn.HnImageData>;
};

export default function SelectImages({ onSelect, data }: SelectImagesProps) {
  const chunkedData = chunk(data.data, 4);

  const handleLoadMore = () => {
    router.reload({ data: { page: data.meta.current_page + 1 }, only: ['data'] });
  };

  return (
    <>
      <div className="grid w-full grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        {Array.from({ length: 4 }).map((_, i) => (
          <div key={i} className="grid gap-4">
            {chunkedData.length - 1 >= i &&
              chunkedData[i].map((item) => (
                <button
                  className="cursor-pointer transition-transform hover:scale-105"
                  onClick={() => onSelect(item)}
                  key={item.id}
                >
                  <Image
                    className="h-full max-w-full rounded-lg object-cover"
                    src={item.image.original_url}
                    alt={item.title}
                  />
                </button>
              ))}
          </div>
        ))}
      </div>
      {data.meta.next_page_url && (
        <div className="flex items-center justify-center">
          <Button className="btn btn-primary mx-auto" onClick={handleLoadMore}>
            نمایش بیشتر
          </Button>
        </div>
      )}
    </>
  );
}
