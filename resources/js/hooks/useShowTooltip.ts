import { useEffect, useState } from 'react';

export default function useShowTooltip() {
  const [showTooltip, setShowTooltip] = useState(true);

  useEffect(() => {
    if (!showTooltip) return;
    setTimeout(() => {
      setShowTooltip(false);
    }, 3_000);
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  return showTooltip;
}
