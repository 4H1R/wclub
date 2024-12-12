import { FieldProps } from '@/shared/forms/FieldWrapper';

const fields = {
  email: {
    isRequired: true,
    name: 'email',
    label: { text: 'ایمیل' },
    attributes: { type: 'email', autoComplete: 'username' },
  },
  password: {
    isRequired: true,
    name: 'password',
    label: { text: 'گذرواژه' },
    attributes: { type: 'password', autoComplete: 'current-password' },
  },
  passwordConfirmation: {
    isRequired: true,
    name: 'password_confirmation',
    label: { text: 'تکرار گذرواژه' },
    attributes: { type: 'password', autoComplete: 'current-password' },
  },
  name: { isRequired: true, name: 'name', label: { text: 'نام و نام خانوادگی' } },
  title: { isRequired: true, name: 'title', label: { text: 'عنوان' } },
  url: { isRequired: true, name: 'url', label: { text: 'آدرس' } },
  alt: { isRequired: true, name: 'alt', label: { text: 'توضیحات عکس' } },
  isActive: { isRequired: false, name: 'is_active', label: { text: 'فعال' } },
  description: {
    isRequired: true,
    name: 'description',
    label: { text: 'توضیحات' },
    inputClassName: 'h-36 ',
    className: 'col-span-full',
  },
  phone: {
    isRequired: true,
    name: 'phone',
    label: { text: 'شماره تلفن' },
    attributes: { type: 'phone', placeholder: '*********09' },
  },
  fullName: { isRequired: true, name: 'full_name', label: { text: 'نام و نام خانوادگی' } },
  firstName: { isRequired: true, name: 'first_name', label: { text: 'نام ' } },
  lastName: { isRequired: true, name: 'last_name', label: { text: ' نام خانوادگی' } },
} as const satisfies Record<string, Omit<FieldProps, 'children'>>;

export default fields;
