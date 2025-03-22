import { cn } from '@/utils';
import { addCommas, digitsEnToFa } from '@persian-tools/persian-tools';
import React from 'react';
import TomanIcon from './icons/TomanIcon';

type PriceProps = {
  price: number | null;
  previousPrice: number | null;
  priceClassName?: string;
  previousPriceClassName?: string;
  tomanClassName?: string;
};

export default function Price({
  price,
  previousPrice,
  tomanClassName,
  priceClassName = 'text-lg',
  previousPriceClassName = 'text-xs',
}: PriceProps) {
  const finalPriceClassName = cn('font-bold', priceClassName);

  return (
    <div className="flex items-center gap-2">
      {!price ? (
        <span className={finalPriceClassName}>رایگان!</span>
      ) : (
        <div className="flex flex-col items-center">
          <div className="flex items-center gap-2">
            <div className={finalPriceClassName}>{digitsEnToFa(addCommas(price))}</div>
            <TomanIcon className={tomanClassName} />
          </div>
          {previousPrice && (
            <div
              className={cn('decoration text-base-content/60 line-through', previousPriceClassName)}
            >
              {digitsEnToFa(addCommas(previousPrice))}
            </div>
          )}
        </div>
      )}
    </div>
  );
}
