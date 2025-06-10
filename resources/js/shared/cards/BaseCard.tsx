import { cn } from '@/utils';
import { Link } from '@inertiajs/react';
import Image from '../images/Image';

type BaseCardProps = {
  data: Pick<App.Data.News.NewsData, 'id' | 'title' | 'short_description' | 'image'>;
  hasWidth?: boolean;
  href: string;
  bodyStartChildren?: React.ReactNode;
  bodyEndChildren?: React.ReactNode;
  image?: { className?: string };
};

export default function BaseCard({
  data,
  href,
  bodyEndChildren,
  bodyStartChildren,
  hasWidth = false,
  image,
}: BaseCardProps) {
  return (
    <div className={cn('card h-full bg-base-100 shadow', { 'w-[22rem]': hasWidth })}>
      <Link href={href}>
        <figure className="h-44 w-full bg-base-200 lg:h-56">
          {data.image && (
            <Image
              className={cn('aspect-square size-full object-cover', image?.className)}
              src={data.image?.original_url}
              alt={data.title}
            />
          )}
        </figure>
      </Link>
      <div className="card-body h-full">
        {bodyStartChildren}
        <p className="card-title line-clamp-2 max-h-fit">{data.title}</p>
        <p className="line-clamp-4 max-h-fit text-sm text-base-content/80">
          {data.short_description}
        </p>
        {bodyEndChildren}
        <Link href={href} className="sr-only">
          بازدید از {data.title}
        </Link>
      </div>
    </div>
  );
}
