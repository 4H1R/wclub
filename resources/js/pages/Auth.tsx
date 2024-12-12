import Button from '@/shared/forms/Button';
import Head from '@/shared/Head';
import Image from '@/shared/images/Image';

export default function Auth() {
  return (
    <div className="container relative mt-10 flex items-center justify-center">
      <Head title="حساب کاربری" description="حساب کاربری" />
      <div className="w-full space-y-4 rounded-box bg-base-200 p-6 md:max-w-xl">
        <Image
          src="/images/logo/logo3.webp"
          width={200}
          height={200}
          className="mx-auto"
          alt="لوگو بانوان آفتاب"
        />
        <h1 className="sr-only">ورود یا ایجاد حساب کاربری خود</h1>
        <p className="text-center text-base-content/80">
          شما میتوانید با ورود یا ایجاد حساب کاربری خود در باشگاه بانوان به خدمات فراوانی که ثبت شده
          دسترسی پیدا کرده و استفاده کنید.
        </p>
        <Button type="submit" className="btn btn-primary btn-block">
          ورود با دولت هوشمند
        </Button>
      </div>
    </div>
  );
}
