import Button from '@/shared/forms/Button';
import Head from '@/shared/Head';
import Image from '@/shared/images/Image';
import { useForm } from '@inertiajs/react';

export default function Auth() {
  const form = useForm({});

  const handleDemoLogin = () => {
    form.post(route('auth.loginDemo'));
  };

  return (
    <div className="container relative mt-10 flex items-center justify-center">
      <Head title="حساب کاربری" description="حساب کاربری" />
      <div className="w-full space-y-4 rounded-box bg-base-200 p-6 md:max-w-xl">
        <Image
          src="/images/logo/logoFull.png"
          width={200}
          height={200}
          className="mx-auto"
          alt="لوگو باشگاه بانوان"
        />
        <h1 className="sr-only">ورود یا ایجاد حساب کاربری خود</h1>
        <p className="text-center text-base-content/80">
          شما میتوانید با ورود یا ایجاد حساب کاربری خود در باشگاه بانوان به خدمات فراوانی که ثبت شده
          دسترسی پیدا کرده و استفاده کنید.
        </p>
        <Button
          onClick={handleDemoLogin}
          isLoading={form.processing}
          disabled={form.processing}
          className="btn btn-primary btn-block"
        >
          ورود با دولت هوشمند
        </Button>
      </div>
    </div>
  );
}
