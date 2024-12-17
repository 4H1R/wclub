import { PageProps } from '@/@types';
import BreadCrumb from '@/shared/BreadCrumb';
import Head from '@/shared/Head';
import { usePage } from '@inertiajs/react';

type TPage = PageProps<{
  series: App.Data.Series.SeriesFullData;
  recommended_series: App.Data.Series.SeriesData[];
}>;

export default function Show() {
  const { series } = usePage<TPage>().props;

  return (
    <div className="space-y mt-page container">
      <Head
        title={`دوره ${series.title}`}
        description={series.short_description ?? series.title}
        imageUrl={series.image?.original_url}
      />
      <BreadCrumb
        links={[
          { title: 'دوره ها', href: route('series.index') },
          { title: series.title, href: '#' },
        ]}
      />
    </div>
  );
}
