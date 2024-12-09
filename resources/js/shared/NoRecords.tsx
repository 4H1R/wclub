import { FaExclamation } from 'react-icons/fa6';

export default function NoRecords() {
  return (
    <div className="card-bordered col-span-full flex h-44 flex-col items-center justify-center gap-4 rounded-box bg-base-100 shadow">
      <div className="rounded-full bg-base-200 p-4">
        <FaExclamation className="size-6" />
      </div>
      <h3 className="text-xl font-bold">هیچ نتیجه‌ای یافت نشد.</h3>
    </div>
  );
}
