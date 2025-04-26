import config from '@/fixtures/config';
import { Head as InertiaHead } from '@inertiajs/react';

type HeadProps = {
  title: string;
  description: string;
  canonicalUrl?: string;
  titleSuffix?: string | null;
  imageUrl?: string;
};
export default function Head({
  title,
  description,
  imageUrl,
  canonicalUrl,
  titleSuffix = config.websiteTitle,
}: HeadProps) {
  const finalTitle = titleSuffix ? `${title} - ${titleSuffix}` : title;

  return (
    <InertiaHead>
      <title>{finalTitle}</title>
      <meta name="description" content={description} />
      <meta property="og:title" content={finalTitle} />
      <meta property="og:description" content={description} />
      {canonicalUrl && <link rel="canonical" href={canonicalUrl} />}
      {imageUrl && <meta property="og:image" content={imageUrl} />}
      <meta property="og:locale" content="fa_IR" />
      <meta property="og:site_name" content={config.websiteTitle} />
      <meta property="twitter:title" content={finalTitle} />
      <meta property="twitter:description" content={description} />
      {imageUrl && <meta property="twitter:image" content={imageUrl} />}
      <script type="application/ld+json">
        {JSON.stringify({
          '@context': 'http://schema.org',
          '@type': 'Webpage',
          name: finalTitle,
          description,
          ...(imageUrl && {
            image: imageUrl,
          }),
        })}
      </script>
    </InertiaHead>
  );
}
