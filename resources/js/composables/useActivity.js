export function useActivity() {
    const formatDate = (dateString) => {
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(dateString).toLocaleDateString('fr-FR', options);
    };

    const formatFullDate = (dateString) => {
      const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
      return new Date(dateString).toLocaleDateString('fr-FR', options);
    };

    const truncate = (text, length) => {
      if (!text) return '';
      if (text.length <= length) return text;
      return text.substring(0, length) + '...';
    };

    const truncateUrl = (url, length) => {
      if (!url) return '';
      const withoutProtocol = url.replace(/^https?:\/\//, '');
      if (withoutProtocol.length <= length) return withoutProtocol;
      return withoutProtocol.substring(0, length) + '...';
    };

    return {
      formatDate,
      formatFullDate,
      truncate,
      truncateUrl
    };
  }
