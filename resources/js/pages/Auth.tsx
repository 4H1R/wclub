import config from '@/fixtures/config';
import fields from '@/fixtures/forms/fields';
import useTimeout from '@/hooks/useTimeout';
import Button from '@/shared/forms/Button';
import FieldWrapper from '@/shared/forms/FieldWrapper';
import Form from '@/shared/forms/Form';
import Input, { InputLists } from '@/shared/forms/Input';
import Head from '@/shared/Head';
import Image from '@/shared/images/Image';
import { cn } from '@/utils';
import { useForm } from '@inertiajs/react';
import get from 'lodash/get';
import React, { useEffect, useState } from 'react';
import OTPInput from 'react-otp-input';
import { toast } from 'react-toastify';
import { DatePicker } from 'zaman';

type TStep = 'send' | 'verify' | 'register';

export default function Auth() {
  const [step, setStep] = useState<TStep>('send');
  const { timeout, handleActiveTimeout } = useTimeout();
  const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    token: '',
    birth_date: '',
  });

  useEffect(() => {
    if (step !== 'verify' || form.data.token.length !== 4) return;
    form.post(route('sms.verify'), {
      preserveState: true,
      preserveScroll: true,
      onError: handleServerError,
      onSuccess: () => setStep('register'),
    });
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [form.data.token, step]);

  const handleServerError = (e: unknown) => {
    const message = get(e, 'message', '') as string;
    if (message) toast.error(message);
  };

  const handleSendAgain = () => {
    form.post(route('sms.send'), {
      preserveState: true,
      preserveScroll: true,
      onError: handleServerError,
      onSuccess: () => {
        toast.success('کد جدیدی برای شما ارسال شد.');
        handleActiveTimeout();
      },
    });
  };

  const handleSubmit = () => {
    if (step === 'send') {
      form.post(route('sms.send'), {
        preserveState: true,
        preserveScroll: true,
        onError: handleServerError,
        onSuccess: () => {
          handleActiveTimeout();
          setStep('verify');
        },
      });
    } else if (step === 'verify') {
      form.post(route('login'));
    } else if (step === 'register') {
      form.post(route('sms.register'), {
        preserveScroll: true,
        preserveState: true,
        onError: (e) => {
          const message = get(e, 'message', '');
          if (message) {
            // code is expired
            toast.error(message);
            form.reset();
            setStep('send');
          }
        },
      });
    }
  };

  const stepsComponents: Record<TStep, React.ReactNode> = {
    send: (
      <>
        <Image
          width={100}
          height={100}
          className="mx-auto mb-4"
          src="/images/logo/logoFull.png"
          alt="لوگو باشگاه بانوان اصفهان"
        />
        <h1 className="text-center text-3xl font-black">
          <span className="text-primary-solo">ورود یا ایجاد</span> حساب کاربری خود
        </h1>
        <p className="text-center text-base-content/80">
          با وارد کردن شماره تلفن خود ما کدی به شماره شما میفرستیم و با وارد کردن آن کد شما به حساب
          کاربری خود وارد یا اگه حساب کاربری نداشته باشید اطلاعات خود را تکمیل میکنید.
        </p>
        <Input {...fields.phone} />
        <Button
          isLoading={form.processing}
          disabled={form.processing}
          type="submit"
          className="btn btn-primary btn-block"
        >
          ارسال کد
        </Button>
      </>
    ),
    verify: (
      <>
        <h1 className="text-center text-3xl font-black">
          <span className="text-primary-solo">چک </span> کردن کد ارسال شده
        </h1>
        <p className="text-center text-base-content/80">
          ما یک کد چهار رقمی به {form.data.phone} فرستادیم
        </p>
        <div dir="ltr" className="flex flex-col items-center justify-center gap-4">
          <OTPInput
            containerStyle={{ width: '100%' }}
            value={form.data.token}
            onChange={(otp) => form.setData('token', otp)}
            numInputs={4}
            renderSeparator={<span className="text-primary-solo">-</span>}
            renderInput={(props) => (
              <input
                disabled={form.processing}
                {...props}
                className="input input-bordered flex-1"
              />
            )}
          />
          <div dir="rtl" className="flex w-full">
            <Button onClick={handleSendAgain} disabled={timeout > 0} className="auth-link">
              ارسال دوباره {timeout > 0 && <span>({timeout})</span>}
            </Button>
          </div>
          {form.processing && (
            <div className="loading-primary loading loading-bars loading-md mx-auto text-primary-solo" />
          )}
        </div>
      </>
    ),
    register: (
      <>
        <h1 className="text-center text-3xl font-black">
          <span className="text-primary-solo">ثبت نام</span> حساب کاربری خود
        </h1>
        <InputLists fields={[fields.firstName, fields.lastName]} />
        <FieldWrapper name="birth_date" isRequired label={{ text: 'تاریخ تولد' }}>
          {({ hasError }) => (
            <DatePicker
              round="x2"
              position="center"
              accentColor={config.primaryColor}
              onChange={(e) => {
                if (hasError) form.clearErrors('birth_date');
                form.setData('birth_date', e.value.toISOString());
                // close date picker
                const overlay = document.getElementsByClassName('rdp__overlay');
                if (overlay.length > 0) {
                  (overlay[0] as HTMLDivElement).click();
                }
              }}
              className="z-10"
              inputClass={cn('input input-bordered w-full', { 'input-error': hasError })}
            />
          )}
        </FieldWrapper>
        <Button
          isLoading={form.processing}
          disabled={form.processing}
          type="submit"
          className="btn btn-primary btn-block"
        >
          ثبت نام
        </Button>
      </>
    ),
  };

  return (
    <div className="container relative mt-10 flex items-center justify-center">
      <Head
        title="حساب کاربری"
        description="ورود یا ایجاد حساب کاربری خود در باشگاه بانوان اصفهان "
      />
      <div className="w-full space-y-4 rounded-box bg-base-200 p-6 md:max-w-xl">
        <Form onSubmit={handleSubmit} form={form} styleMode="base">
          {stepsComponents[step]}
        </Form>
      </div>
    </div>
  );
}
