import SharedCardProperties from '@/components/cards/SharedCardProperties';
import { slugifyId } from '@/utils';
import BaseCard from './BaseCard';

type ContestCardProps = {
  contest: App.Data.Contest.ContestData;
  hasWidth?: boolean;
};

export default function ContestCard({ contest, hasWidth = false }: ContestCardProps) {
  const href = route('contests.show', [slugifyId(contest.id, contest.title)]);

  return (
    <BaseCard
      data={contest}
      href={href}
      hasWidth={hasWidth}
      bodyEndChildren={
        <SharedCardProperties
          categories={contest.categories}
          targetGroups={contest.target_groups}
        />
      }
    />
  );
}
