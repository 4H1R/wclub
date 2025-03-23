import { PageProps } from '@/@types';
import SeriesCard from '@/shared/cards/SeriesCard';
import Head from '@/shared/Head';
import NoRecords from '@/shared/NoRecords';
import Pagination from '@/shared/Pagination';
import { PaginatedCollection } from '@/types';
import { usePage } from '@inertiajs/react';
import React from 'react';

type TPage = PageProps<{
  series: PaginatedCollection<App.Data.Series.SeriesData>;
}>;

export default function Series() {
  const { series } = usePage<TPage>().props;

  return (
    <div className="space-y col-span-full">
      <Head title="دوره ها" description="دوره ها" />
      {series.meta.total < 1 && <NoRecords />}
      <div className="content-grid-container">
        {series.data.map((series) => (
          <SeriesCard key={series.id} series={series} />
        ))}
      </div>
      <Pagination data={series} />
    </div>
  );
}
