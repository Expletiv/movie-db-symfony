import {Controller} from "@hotwired/stimulus";

export default class extends Controller {

  static targets = ["iframe"];

  declare iframeTargets: HTMLIFrameElement[];

  private observer: IntersectionObserver | null = null;

  connect() {
    this.initializeObserver();
  }

  disconnect() {
    this.disconnectObserver();
  }

  initializeObserver() {
    // IntersectionObserver is used to lazy load the iframe
    this.observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const iframe = entry.target as HTMLIFrameElement;
          iframe.src = iframe.dataset.src || '';
          this.observer?.unobserve(iframe);
        }
      });
    });

    this.iframeTargets.forEach(iframe => {
      this.observer?.observe(iframe);
    });
  }

  disconnectObserver() {
    if (this.observer) {
      this.observer.disconnect();
      this.observer = null;
    }
  }

  stopVideos() {
    this.iframeTargets.forEach(iframe => {
      iframe.contentWindow?.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
    });
  }

}
