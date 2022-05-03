enum BookType {
  'SF' = 'SF',
  'HORROR' = 'HORROR'
}

export abstract class book {
    public type: BookType;

    protected abstract getType(): BookType
}

export  class bookChildren extends book {
  protected getType(): BookType {
    return undefined;
  }
}