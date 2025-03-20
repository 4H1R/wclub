import { PageProps } from '@/@types';
import ConvertToCouponCard from '@/components/dashboard/score/ConvertToCouponCard';
import TransferScoreCard from '@/components/dashboard/score/TransferScoreCard';
import { usePage } from '@inertiajs/react';

type TPage = PageProps<{
  score_to_coupon_logic: { score_amount: number; coupon_amount: number }[];
}>;

export default function Score() {
  const { score_to_coupon_logic } = usePage<TPage>().props;

  return (
    <>
      <ConvertToCouponCard logic={score_to_coupon_logic} />
      <TransferScoreCard />
    </>
  );
}
