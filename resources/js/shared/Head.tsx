import { Head as InertiaHead } from '@inertiajs/react';

type HeadProps = {
  title: string;
  description: string;
  titleSuffix?: string | null;
};
export default function Head({ title, description, titleSuffix = 'باشگاه بانوان' }: HeadProps) {
  const finalTitle = titleSuffix ? `${title} - ${titleSuffix}` : title;

  return (
    <InertiaHead>
      <title>{finalTitle}</title>
      <meta name="description" content={description} />
      <meta property="og:title" content={finalTitle} />
      <meta property="og:description" content={description} />
      <meta property="twitter:title" content={finalTitle} />
      <meta property="twitter:description" content={description} />
      <script type="application/ld+json">
        {JSON.stringify({
          '@context': 'http://schema.org',
          '@type': 'Webpage',
          name: finalTitle,
          description,
        })}
      </script>
    </InertiaHead>
  );
}
