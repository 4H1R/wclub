import { useEffect, useState } from 'react';

export default function useTimeout(defaultAmount = 60, amount = 60) {
  const [timeout, setTimeout] = useState(defaultAmount);

  const handleActiveTimeout = () => {
    setTimeout(amount);
  };

  useEffect(() => {
    const interval = setInterval(() => {
      if (timeout > 0) setTimeout((prev) => prev - 1);
    }, 1000);

    return () => clearInterval(interval);
  }, [timeout]);

  return { timeout, handleActiveTimeout } as const;
}
