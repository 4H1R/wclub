import { PageProps } from '@/@types';
import fields from '@/fixtures/forms/fields';
import Form from '@/shared/forms/Form';
import { InputLists } from '@/shared/forms/Input';
import { calculateAge, convertNullToEmptyString } from '@/utils';
import { useForm, usePage } from '@inertiajs/react';

export default function InfoCard() {
  const { auth } = usePage<PageProps>().props;
  const form = useForm(
    convertNullToEmptyString({
      first_name: auth.user!.first_name,
      last_name: auth.user!.last_name,
      email: auth.user!.email,
      phone: auth.user!.phone,
      age: calculateAge(auth.user!.birth_date),
    }),
  );

  return (
    <div className="card card-bordered card-compact bg-base-100">
      <div className="card-body">
        <h2 className="card-title">اطلاعات حساب کاربری</h2>
        <Form form={form} onSubmit={() => {}} styleMode="base">
          <InputLists
            fields={[
              { ...fields.firstName, isRequired: false, attributes: { readOnly: true } },
              { ...fields.lastName, isRequired: false, attributes: { readOnly: true } },
              { ...fields.age, isRequired: false, attributes: { readOnly: true } },
              { ...fields.phone, isRequired: false, attributes: { readOnly: true } },
              { ...fields.email, isRequired: false, attributes: { readOnly: true } },
            ]}
          />
        </Form>
      </div>
    </div>
  );
}
