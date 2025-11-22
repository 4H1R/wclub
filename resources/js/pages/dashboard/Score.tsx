import { PageProps } from '@/@types';
import ConvertToCouponCard from '@/components/dashboard/score/ConvertToCouponCard';
import CouponsTable from '@/components/dashboard/score/CouponsTable';
// import TransferScoreCard from '@/components/dashboard/score/TransferScoreCard';
import Head from '@/shared/Head';
import { usePage } from '@inertiajs/react';

type TPage = PageProps<{
  score_to_coupon_logic: { score_amount: number; coupon_amount: number }[];
  coupons: App.Data.Coupon.CouponData[];
}>;

export default function Score() {
  const { score_to_coupon_logic, coupons } = usePage<TPage>().props;

  return (
    <>
      <Head title="امتیازات" description="امتیازات" />
      <ConvertToCouponCard logic={score_to_coupon_logic} />
      {/* <TransferScoreCard /> */}
      {coupons.length > 0 && <CouponsTable coupons={coupons} />}
    </>
  );
}
