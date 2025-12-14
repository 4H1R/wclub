import { PageProps } from '@/@types';
import BreadCrumb from '@/shared/BreadCrumb';
import NewsCard from '@/shared/cards/NewsCard';
import Head from '@/shared/Head';
import Image from '@/shared/images/Image';
import CategoriesBadge from '@/shared/resources/show/CategoriesBadge';
import ShareButton from '@/shared/resources/show/ShareButton';
import VideoJS from '@/shared/VideoJs';
import { slugifyId } from '@/utils';
import { usePage } from '@inertiajs/react';
import Markdown from 'react-markdown';

type TPage = PageProps<{
  news: App.Data.News.NewsFullData;
  recommended_news: App.Data.News.NewsData[];
}>;

export default function Show() {
  const { news, recommended_news } = usePage<TPage>().props;

  return (
    <div className="space-y mt-page container">
      <Head
        canonicalUrl={route('news.show', [slugifyId(news.id, news.title)])}
        title={`خبر ${news.title}`}
        description={news.short_description}
        imageUrl={news.image?.original_url}
      />
      <BreadCrumb
        links={[
          { title: 'اخبار', href: route('news.index') },
          { title: news.title, href: '#' },
        ]}
      />
      <div className="space-y">
        {news.image && (
          <Image
            className="mx-auto aspect-square w-full rounded-box object-cover lg:max-h-[40vh] lg:w-[70%]"
            src={news.image?.original_url}
            alt={news.title}
          />
        )}
        <div className="flex flex-col gap-3">
          <div className="flex flex-wrap items-center justify-between gap-4">
            <h1 className="h1">{news.title}</h1>
            <ShareButton predefinedStyleFor="desktop" />
          </div>
          <CategoriesBadge categories={news.categories} />
        </div>
        {news.video && (
          <VideoJS
            options={{
              autoplay: false,
              playbackRates: [0.5, 1, 1.5, 2],
              controls: true,
              responsive: true,
              fluid: true,
              sources: [
                {
                  src: news.video.original_url,
                  type: news.video.mime_type,
                },
              ],
            }}
          />
        )}
        <div className="prose max-w-none text-base-content">
          <Markdown>{news.description}</Markdown>
        </div>
      </div>
      <div className="divider clear-both md:pt-6" />
      <h2 className="h2">اخبار های دیگر</h2>
      <div className="content-grid-container show-content-grid-container">
        {recommended_news.map((data) => (
          <NewsCard key={data.id} news={data} />
        ))}
      </div>
    </div>
  );
}
