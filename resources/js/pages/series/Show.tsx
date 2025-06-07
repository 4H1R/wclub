import { PageProps } from '@/@types';
import CartAction from '@/components/series/show/CartAction';
import CategoriesCard from '@/components/series/show/CategoriesCard';
import ChaptersCard from '@/components/series/show/ChaptersCard';
import Description from '@/components/series/show/Description';
import Faqs from '@/components/series/show/Faqs';
import SideStatsCard from '@/components/series/show/SideStatsCard';
import BreadCrumb from '@/shared/BreadCrumb';
import SeriesCard from '@/shared/cards/SeriesCard';
import Head from '@/shared/Head';
import Image from '@/shared/images/Image';
import Price from '@/shared/Price';
import { slugifyId } from '@/utils';
import { usePage } from '@inertiajs/react';
import { GoDotFill } from 'react-icons/go';

type TPage = PageProps<{
  series: App.Data.Series.SeriesFullData;
  recommended_series: App.Data.Series.SeriesData[];
}>;

export default function Show() {
  const { series, recommended_series } = usePage<TPage>().props;

  return (
    <div className="space-y mt-page container">
      <Head
        canonicalUrl={route('series.show', [slugifyId(series.id, series.title)])}
        title={`دوره ${series.title}`}
        description={series.short_description}
        imageUrl={series.image?.original_url}
      />
      <BreadCrumb
        links={[
          { title: 'دوره ها', href: route('series.index') },
          { title: series.title, href: '#' },
        ]}
      />
      <div className="card card-compact bg-base-200 md:card-normal">
        <div className="card-body">
          <div className="flex flex-col-reverse gap-4 md:flex-row md:justify-between md:gap-8">
            <div className="flex-1 space-y-4">
              <h1 className="h2 text-center md:text-start">{series.title}</h1>
              <p className="text-md text-base-content/80">{series.short_description}</p>
              <div className="flex flex-col items-center justify-between gap-4 pt-8 md:flex-row">
                <CartAction series={series} />
                <Price
                  tomanClassName="size-5"
                  priceClassName="text-2xl"
                  previousPriceClassName="text-xl"
                  price={series.price}
                  previousPrice={series.previous_price}
                />
              </div>
            </div>
            <figure className="h-56 w-full rounded-box bg-base-300 md:w-2/6">
              {series.image && (
                <Image className="size-full" alt={series.title} src={series.image.original_url} />
              )}
            </figure>
          </div>
        </div>
      </div>
      <div className="side-grid-container">
        <div className="space-y-4 lg:col-span-7">
          <div className="card card-compact bg-base-200 md:card-normal">
            <div className="card-body">
              <div className="space-y-4">
                <div className="flex items-center justify-center gap-2 md:justify-start">
                  <GoDotFill className="hidden size-4 md:block" />
                  <h2 className="h2 text-base-content md:text-start">توضیحات</h2>
                </div>
                <Description description={series.description} />
                <Faqs faqsArray={series.faqs_array} />
              </div>
            </div>
          </div>
          <ChaptersCard series={series} />
        </div>
        <div className="space-y-4 lg:col-span-3">
          <SideStatsCard series={series} />
          <CategoriesCard categories={series.categories} />
        </div>
      </div>
      <div className="divider" />
      <div className="space-y-4">
        <h2 className="h2 text-base-content md:text-start">دوره های پیشنهادی</h2>
      </div>
      <div className="content-grid-container show-content-grid-container">
        {recommended_series.map((series) => (
          <SeriesCard key={series.id} series={series} />
        ))}
      </div>
    </div>
  );
}
