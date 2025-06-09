import SharedCardProperties from '@/components/cards/SharedCardProperties';
import { cn, slugifyId } from '@/utils';
import { Link } from '@inertiajs/react';
import Image from '../images/Image';

type NewsCardProps = {
  news: App.Data.News.NewsData;
  hasWidth?: boolean;
};

export default function NewsCard({ news, hasWidth = false }: NewsCardProps) {
  const href = route('news.show', [slugifyId(news.id, news.title)]);

  return (
    <div className={cn('card h-full bg-base-100 shadow', { 'w-[22rem]': hasWidth })}>
      <Link href={href}>
        <figure className="h-44 w-full bg-base-200 lg:h-56">
          {news.image && (
            <Image className="size-full" src={news.image?.original_url} alt={news.title} />
          )}
        </figure>
      </Link>
      <div className="card-body h-full">
        <h2 className="card-title">{news.title}</h2>
        <p className="line-clamp-4 max-h-fit text-sm text-base-content/80">
          {news.short_description}
        </p>
        <SharedCardProperties targetGroups={news.target_groups} categories={news.categories} />
      </div>
    </div>
  );
}
