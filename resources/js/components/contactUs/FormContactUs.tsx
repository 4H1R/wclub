import { PageProps } from '@/@types';
import fields from '@/fixtures/forms/fields';
import Button from '@/shared/forms/Button';
import Form from '@/shared/forms/Form';
import HoneyPot from '@/shared/forms/Honeypot';
import { InputLists } from '@/shared/forms/Input';
import Textarea from '@/shared/forms/Textarea';
import { THoneypot } from '@/types';
import { convertNullToEmptyString } from '@/utils';
import { useForm, usePage } from '@inertiajs/react';
import { HiOutlineCheckCircle } from 'react-icons/hi2';
import { toast } from 'react-toastify';

type TPage = PageProps<{
  data: object;
  hp: THoneypot;
}>;

export default function FormContactUs() {
  const { data, hp } = usePage<TPage>().props;
  const form = useForm(
    convertNullToEmptyString({
      ...data,
      [hp.nameFieldName]: '',
      [hp.validFromFieldName]: hp.encryptedValidFrom,
    }),
  );
  const { post, processing, reset } = form;
  const successMessage = 'اطلاعات شما با موفقیت ثبت شد. به زودی با شما تماس میگیریم';

  const handleSubmit = () => {
    post(route('contactUs'), {
      onSuccess: () => {
        reset();
        toast.success(successMessage);
      },
    });
  };

  return (
    <Form form={form} onSubmit={handleSubmit} styleMode="grid">
      {form.wasSuccessful && (
        <div role="alert" className="alert alert-success col-span-full">
          <HiOutlineCheckCircle className="size-6" />
          <span>{successMessage}</span>
        </div>
      )}
      <InputLists
        fields={[
          fields.fullName,
          fields.phone,
          { ...fields.email, isRequired: false },
          fields.title,
        ]}
      />
      <HoneyPot honeypot={hp} />
      <Textarea {...fields.description} />
      <div className="col-span-full w-full">
        <Button
          type="submit"
          className="btn btn-primary btn-block md:w-auto"
          disabled={processing}
          isLoading={processing}
        >
          ثبت
        </Button>
      </div>
    </Form>
  );
}
