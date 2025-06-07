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
        {news.categories.length > 0 && (
          <div className="flex flex-wrap items-center gap-1 pb-6 pt-2">
            {news.categories.map((category) => (
              <span key={category.id} className="badge badge-md bg-base-200">
                {category.title}
              </span>
            ))}
          </div>
        )}
        {/* <Link className="btn mt-auto" href={href}>
          <span>اطلاعات بیشتر</span>
        </Link> */}
      </div>
    </div>
  );
}
