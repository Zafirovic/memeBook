class MemeText {
    /**
     * @param {string} content
     * @param {string} fontFamily
     * @param {number} fontSize
     * @param {boolean} textShadow
    */
    constructor(content, fontFamily, fontSize, textShadow) {
        this.content = content;
        this.fontFamily = fontFamily;
        this.fontSize = fontSize;
        this.textShadow = textShadow;
    }
}

/*
 * MemeTextBuilder adds flexibility to MemeText construction
 */
export default class MemeTextBuilder {
    constructor() {
      this.memeTextContent = {};
    }

    withContent(content) {
        this.memeTextContent.content = content;
        return this;
    }

    withFontFamily(fontFamily) {
        this.memeTextContent.fontFamily = fontFamily;
        return this;
    }

    withFontSize(fontSize) {
        this.memeTextContent.fontSize = fontSize;
        return this;
    }

    withTextShadow(textShadow) {
        this.memeTextContent.textShadow = textShadow;
        return this;
    }

    build() {
        const { content, fontFamily, fontSize, textShadow } = this.memeTextContent;
        return new MemeText(content, fontFamily, fontSize, textShadow);
    }
}