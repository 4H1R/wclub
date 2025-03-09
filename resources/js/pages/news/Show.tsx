import { PageProps } from '@/@types';
import BreadCrumb from '@/shared/BreadCrumb';
import NewsCard from '@/shared/cards/NewsCard';
import Button from '@/shared/forms/Button';
import Head from '@/shared/Head';
import Image from '@/shared/images/Image';
import CategoriesBadge from '@/shared/resources/show/CategoriesBadge';
import ShareButton from '@/shared/resources/show/ShareButton';
import { usePage } from '@inertiajs/react';
import { HiOutlineInformationCircle } from 'react-icons/hi2';
import Markdown from 'react-markdown';

type TPage = PageProps<{
  news: App.Data.News.NewsFullData;
  recommended_news: App.Data.News.NewsData[];
}>;

const registerId = 'registerId';

export default function Show() {
  const { news, recommended_news } = usePage<TPage>().props;

  const handleScrollToRegister = () => {
    document.getElementById(registerId)?.scrollIntoView({ behavior: 'smooth' });
  };

  return (
    <div className="space-y mt-page container">
      <Head
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
      <div className="space-y lg:mx-auto lg:max-w-[70%]">
        {news.image && (
          <Image
            className="w-full rounded-box object-contain"
            src={news.image?.original_url}
            alt={news.title}
          />
        )}
        <div className="space-y-3">
          <div className="flex flex-wrap items-center justify-between gap-4">
            <h1 className="h1">{news.title}</h1>
            <ShareButton predefinedStyleFor="desktop" />
          </div>
          <CategoriesBadge categories={news.categories} />
          <div className="flex flex-wrap items-center justify-between gap-4 rounded-box bg-base-200 text-base-content/80 md:hidden">
            <Button onClick={handleScrollToRegister} className="btn btn-ghost">
              <HiOutlineInformationCircle className="size-5" />
              <span>اطلاعات بیشتر</span>
            </Button>
            <ShareButton predefinedStyleFor="mobile" />
          </div>
        </div>
        <div className="prose max-w-none text-base-content">
          <Markdown>{news.description}</Markdown>
        </div>
      </div>
      <div className="divider clear-both md:pt-6" />
      <h2 className="h2">اخبار های دیگر</h2>
      <div className="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
        {recommended_news.map((data) => (
          <NewsCard key={data.id} news={data} />
        ))}
      </div>
    </div>
  );
}
