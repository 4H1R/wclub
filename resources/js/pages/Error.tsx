import { PageProps } from '@/@types';
import error403 from '@/assets/svg/errors/403.svg';
import error404 from '@/assets/svg/errors/404.svg';
import error500 from '@/assets/svg/errors/500.svg';
import error503 from '@/assets/svg/errors/503.svg';
import Button from '@/shared/forms/Button';
import Head from '@/shared/Head';
import Image from '@/shared/images/Image';
import { Link, usePage } from '@inertiajs/react';
import { digitsEnToFa } from '@persian-tools/persian-tools';
import React from 'react';

type TPage = PageProps<{
  status: number;
}>;

function Error() {
  const { status } = usePage<TPage>().props;

  const title = {
    503: 'در حال تعمیر سایت.',
    500: 'مشکلی پیش آمده.',
    404: 'صفحه پیدا نشد.',
    403: 'نداشتن دسترسی لازم.',
  }[status]!;

  const illustration = {
    404: error404,
    403: error403,
    500: error500,
    503: error503,
  }[status]!;

  const description = {
    503: 'ما در حال تعمیر سایت هستیم لطفا چند دقیقه دیگر دوباره تلاش کنید.',
    500: 'انگار مشکلی پیش آمده لطفا بعدا دوباره تلاش کنید یا با ما تماس بگیرید.',
    404: ' صفحه ای که دنبالش هستید پیدا نشد شما میتوانید به صفحه اصلی برگردید.',
    403: 'شما دسترسی لازم برای دیدن این صفحه را ندارید.',
  }[status]!;

  const handleBack = () => {
    window.history.back();
  };

  return (
    <div className="container flex min-h-svh flex-col items-center justify-center gap-4 text-center">
      <Head title={title} titleSuffix={null} description={description} />
      <Image
        className="mb-8 max-w-xs sm:max-w-md md:max-w-xl"
        loading="eager"
        src={illustration}
        alt={title}
      />
      <h1 className="h1">
        {digitsEnToFa(status)} | {title}
      </h1>
      <p className="text-lg text-base-content/80">{description}</p>
      <div className="flex items-center gap-4">
        <Button onClick={handleBack} className="btn btn-outline">
          بازگشت به صفحه قبلی
        </Button>
        <Link className="btn btn-primary" href="/">
          بازگشت به صفحه اصلی
        </Link>
      </div>
    </div>
  );
}

Error.layout = (page: React.ReactNode) => page;

export default Error;
