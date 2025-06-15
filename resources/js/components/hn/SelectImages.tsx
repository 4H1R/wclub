import { TData } from '@/pages/hn/Start';
import Image from '@/shared/images/Image';
import { chunk } from '@/utils';
import React from 'react';

type SelectImagesProps = {
  onSelect: (data: TData) => void;
};

export default function SelectImages({ onSelect }: SelectImagesProps) {
  const test: TData[] = Array.from({ length: 30 }).map((_, i) => ({
    id: i + 1,
    image: { id: 1, original_url: '/images/hn/back/mug.webp' },
  }));

  const chunkedData = chunk(test, 4);

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
                    alt={(i + 1).toString()}
                  />
                </button>
              ))}
          </div>
        ))}
      </div>
    </>
  );
}
