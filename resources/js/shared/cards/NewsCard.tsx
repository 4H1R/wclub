import SharedCardProperties from '@/components/cards/SharedCardProperties';
import { slugifyId } from '@/utils';
import BaseCard from './BaseCard';

type NewsCardProps = {
  news: App.Data.News.NewsData;
  hasWidth?: boolean;
};

export default function NewsCard({ news, hasWidth = false }: NewsCardProps) {
  const href = route('news.show', [slugifyId(news.id, news.title)]);

  return (
    <BaseCard
      data={news}
      href={href}
      hasWidth={hasWidth}
      bodyEndChildren={
        <SharedCardProperties categories={news.categories} targetGroups={news.target_groups} />
      }
    />
  );
}
