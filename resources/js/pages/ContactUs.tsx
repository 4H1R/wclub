import FormContactUs from '@/components/contactUs/FormContactUs';
import Head from '@/shared/Head';

export default function ContactUs() {
  return (
    <div className="space-y mt-page container">
      <Head title="تماس با ما" description="تماس با ما" />
      <div className="space-y-4 text-center">
        <h1 className="h1 text-base-content">تماس با ما</h1>
        <p className="text-base-content/80">
          اگر سوالی دارید یا دوست دارید با ما همکاری کنید میتوانید با ما در تماس باشید و ما همیشه
          پاسخ گوی شما هستیم
        </p>
      </div>
      <FormContactUs />
    </div>
  );
}
